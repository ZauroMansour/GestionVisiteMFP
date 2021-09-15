<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Visite;
use App\Form\VisiteType;
use App\Repository\MotifDemandeRepository;
use App\Repository\ServiceRepository;
use App\Repository\UserRepository;
use App\Repository\VisiteRepository;
use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use phpDocumentor\Reflection\PseudoTypes\False_;

/**
 * @Route("/visite")
 */
class VisiteController extends AbstractController
{
    /**
     * @Route("/list", name="visite_index", methods={"GET"})
     */
    public function index(VisiteRepository $visiteRepository): Response
    {

        if (!$this->getUser()->getActive()) {
            $this
                ->get('session')->getFlashBag()
                ->add('resetpwd', "Vous devez reinitialiser votre mot de passe!");
            return $this->redirectToRoute('reset_password');
        }
        $user = $this->getUser();
        $service = $user->getService();

        if ($this->isGranted('ROLE_ADMIN')) {
            // Execute some php code here
            $visites = $visiteRepository->findBy([], ['id' => 'DESC']);
         }
         else{
        $visites = $visiteRepository->findBy(['service' => $service], ['id' => 'DESC']);
         }
        return $this->render('visite/index.html.twig', [
            'visites' => $visites,
        ]);
    }

    /**
     * @Route("/new/{service_id?}", name="visite_new", methods={"GET","POST"})
     * @param Request $request
     * @param $service_id
     * @param ServiceRepository $serviceRepository
     * @return Response
     * @throws \Exception
     */
    public function new(Request $request, $service_id, ServiceRepository $serviceRepository, UserRepository $agentRepository, MotifDemandeRepository $objet_demande_repo, \Swift_Mailer $mailer, string $photoDir): Response
    {

        $visite = new Visite();
        $objet_demande_id = $request->query->get('objet');

        if (!isset($service_id) && empty($objet_demande_id)) {
            return $this->redirectToRoute('structure');
        }

        if ($objet_demande_id) {
            $objet_demande = $objet_demande_repo->find($objet_demande_id);
            $service = $objet_demande->getService();
            $service_id = $service->getId();
            $visite->setMotifDemande($objet_demande);
        } else {
            $service = $serviceRepository->find($service_id);
        }

        if ($service->getAgent()) {
            $visite->setCin(null);
        } else {
            $visite->setMatricule(null);
        }
        $visite->setDateVisite(new DateTime());
        $visite->setDateDemande(new DateTime());
        $form = $this->createForm(VisiteType::class, $visite, ['service_id' => $service_id, 'edit' => false]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($photo = $form['CNIname']->getData()) {
                $filename = $visite->getCin() . '_' . $visite->getDateVisite()->format('d-m-Y') . '.'.$photo->guessExtension();
                try {
                $photo->move($photoDir, $filename);
                } catch (FileException $e) {
                // unable to upload the photo, give up
                }
                $visite->setCNIname($filename);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $visite->setService($service);
            $visite->setStructure($service->getStructure());
            $entityManager->persist($visite);
            $entityManager->flush();

            $this
                ->get('session')->getFlashBag()
                ->add('success', "Votre demande a été soumise!");


//            recuperer la liste des email agents du service
            $agents = $agentRepository->findBy(['service' => $service]);
            $emails = array_map(function ($item) {
                return  $item->getEmail();
            }, $agents);
            $message = (new \Swift_Message('Fonction Publique - Gestion des visites - nouvelle demande'))
                ->setFrom('nepasrepondre@fonctionpublique.gouv.sn')
                ->setTo($emails)
                ->setBody(
                    $this->renderView(
                        'emails/demande.html.twig',
                        ['visite' => $visite]
                    ),
                    'text/html'
                )
            ;

            $mailer->send($message);

            return $this->redirectToRoute('structure');
        }

        return $this->render('visite/new.html.twig', [
            'visite' => $visite,
            'service' => $service,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="visite_show", methods={"GET"})
     */
    public function show(Visite $visite, string $photoDir): Response
    {
        if (!$this->getUser()->getActive()) {
            $this
                ->get('session')->getFlashBag()
                ->add('resetpwd', "Vous devez reinitialiser votre mot de passe!");
            return $this->redirectToRoute('reset_password');

        }
        
        return $this->render('visite/show.html.twig', [
            'visite' => $visite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="visite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Visite $visite, \Swift_Mailer $mailer): Response
    {
        if (!$this->getUser()->getActive()) {
            $this
                ->get('session')->getFlashBag()
                ->add('resetpwd', "Vous devez reinitialiser votre mot de passe!");
            return $this->redirectToRoute('reset_password');
        }
        $service = $visite->getMotifDemande()->getService();
        $form = $this->createForm(VisiteType::class, $visite, ['service_id' => $service->getId(), 'edit' => true]);
        $form->handleRequest($request);
        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) 
        {
            
            $this->getDoctrine()->getManager()->flush();
            // cas oú la demande est validée
            $entityManager = $this->getDoctrine()->getManager();
            $visite->setReponse('Demande validée');
            $entityManager->persist($visite);
            $entityManager->flush();


            // on utile dompdf pour générer l'attestion apres validation de la demande

            //on definie les options du pdf
            $pdfoption = new Options();
            //police par defaut
            $pdfoption->set('defaultFont', 'Arial');
            $pdfoption->setIsRemoteEnabled(true);
             //on instencie dompdf
             $dompdf = new Dompdf($pdfoption);
             $context = stream_context_create([
                 'ssl' => [
                     'verify_peer' => False,
                     'verify_peer_name' => False,
                     'allow_self_signed' => True
                 ] 
             ]);
             $dompdf->setHttpContext($context);

             //on génére le html
             $html = $this->renderView('visite/attestation.html.twig', [
                'visite' => $visite,
                'user' => $user,
                ]);
             $dompdf->loadHtml($html);
             $dompdf->setPaper('A4', 'portrait');
             $dompdf->render();

             //on génére un nom de fichier
             
             $fichier = 'Attestation' .$visite->getCin() .'.pdf';

             //on envoie le pdf au navigateur
             $dompdf->stream($fichier,[
                 'Attachment' => True
             ]);

            // Sending mail ...
            $message = (new \Swift_Message('Fonction Publique - Gestion des visites'))
                ->setFrom('nepasrepondre@fonctionpublique.gouv.sn')
                ->setTo($visite->getEmail())
                ->setBody(
                    $this->renderView(
                        'emails/reponse.html.twig',
                        ['visite' => $visite]
                    ),
                    'text/html'
                )
            ;
            $mailer->send($message);
           return $this->redirectToRoute('visite_index');
        
        $this
             ->get('session')->getFlashBag()
             ->add('success', "La demande a été traitée!");
    }
    return $this->render('visite/edit.html.twig', [
        'visite' => $visite,
        'service' => $service,
        'user' => $user,
        'form' => $form->createView(),
    ]);
    return $this->redirectToRoute('visite_index');
    }

    /**
     * @Route("/{id}/edit/rejet", name="visite_rejet", methods={"GET","POST"})
     */
    public function rejet(Request $request, Visite $visite, \Swift_Mailer $mailer): Response
    {
        $this->getDoctrine()->getManager()->flush();

            // cas oú la demande est rejetée
            $entityManager = $this->getDoctrine()->getManager();
            $visite->setReponse('Demande rejetée');
            $entityManager->persist($visite);
            $entityManager->flush();

            $this
                ->get('session')->getFlashBag()
                ->add('success', "La demande a été rejetée!");
            
        
            // Sending mail ...
            $message = (new \Swift_Message('Fonction Publique - Gestion des visites'))
                ->setFrom('nepasrepondre@fonctionpublique.gouv.sn')
                ->setTo($visite->getEmail())
                ->setBody(
                    $this->renderView(
                        'emails/rejet.html.twig',
                        ['visite' => $visite]
                    ),
                    'text/html'
                )
            ;
            $mailer->send($message);
          return $this->redirectToRoute('visite_index');
    }
}