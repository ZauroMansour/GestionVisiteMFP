<?php

namespace App\Controller;

use App\Entity\AgentEtat;
use App\Entity\Image;
use App\Form\AgentEtatType;
use App\Repository\AgentEtatRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class AgentEtatController extends AbstractController
{
    /**
     * @Route("/agentetat", name="agent_etat_index", methods={"GET"})
     */
    public function index(AgentEtatRepository $agentEtatRepository): Response
    {
        return $this->render('agent_etat/index.html.twig', [
            'agent_etats' => $agentEtatRepository->findAll(),
        ]);
    }

    /**
     * @Route("/agentetat/new", name="agent_etat_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $agentEtat = new AgentEtat();
        $form = $this->createForm(AgentEtatType::class, $agentEtat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


             // On récupère les images transmises
             $images = $agentEtat->$this->get('images')->getData();

             dd($images);

             // On boucle sur les images
             foreach($images as $image){
                 // On génère un nouveau nom de fichier
                 $fichier = md5(uniqid()) . '.' . $image->guessExtension();
 
                 // On copie le fichier dans le dossier uploads
                 $image->move(
                     $this->getParameter('images_directory'),
                     $fichier
                 );
 
                 // On stocke l'image dans la base de données (son nom)
                 $img = new Image();
                 $img->setName($fichier);
                 $agentEtat->addImage($img);
             }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($agentEtat);
            $entityManager->flush();

            return $this->redirectToRoute('agent_etat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('agent_etat/new.html.twig', [
            'agent_etat' => $agentEtat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("agentetat/{id}", name="agent_etat_show", methods={"GET"})
     */
    public function show(AgentEtat $agentEtat): Response
    {
        return $this->render('agent_etat/show.html.twig', [
            'agent_etat' => $agentEtat,
        ]);
    }

    /**
     * @Route("/agentetat/{id}/edit", name="agent_etat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AgentEtat $agentEtat): Response
    {
        $form = $this->createForm(AgentEtatType::class, $agentEtat);
        $form->handleRequest($request);

    // dd($form);
    //    $idAgent = $agentEtat->getIdAgent();
    //    $agentEtat->setIdAgent($idAgent);
    
        $agentEtat->setDatetraitement(new DateTime());
    


        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('agent_etat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('agent_etat/edit.html.twig', [
            'agent_etat' => $agentEtat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/agentetat/{id}", name="agent_etat_delete", methods={"POST"})
     */
    public function delete(Request $request, AgentEtat $agentEtat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$agentEtat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($agentEtat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('agent_etat_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/edit/rejet", name="agent_etat_rejet", methods={"GET","POST"})
     */
    public function rejet(Request $request, AgentEtat $agentEtat, \Swift_Mailer $mailer): Response
    {
        $this->getDoctrine()->getManager()->flush();

            // cas oú la demande est rejetée
            $entityManager = $this->getDoctrine()->getManager();
            $agentEtat->setReponse('Demande rejetée');
            $entityManager->persist($agentEtat);
            $entityManager->flush();

            $this
                ->get('session')->getFlashBag()
                ->add('success', "La demande a été rejetée!");
            
        
            // Sending mail ...
            $message = (new \Swift_Message('Fonction Publique - Gestion des réclamations'))
                ->setFrom('nepasrepondre@fonctionpublique.gouv.sn')
                ->setTo($agentEtat->getEmail())
                ->setBody(
                    $this->renderView(
                        'emails/rejet_reclamation.html.twig',
                        ['agentEtat' => $agentEtat]
                    ),
                    'text/html'
                )
            ;
            $mailer->send($message);
          return $this->redirectToRoute('agent_etat_index');
    }
}
