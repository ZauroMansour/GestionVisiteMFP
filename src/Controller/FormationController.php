<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Entity\Thematique;
use App\Entity\User;
use App\Form\Formation1Type;
use App\Repository\FormationRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @Route("/formation")
 */
class FormationController extends AbstractController
{
    /**
     * @Route("/fp_admin", name="formation_index", methods={"GET"})
     */
    public function index(FormationRepository $formationRepository): Response
    {
        // if (!$this->getUser()->getActive()) {
        //     $this
        //         ->get('session')->getFlashBag()
        //         ->add('resetpwd', "Vous devez reinitialiser votre mot de passe!");
        //     return $this->redirectToRoute('reset_password');
        // }

        if ($this->isGranted('ROLE_ADMIN')) {
            $formation = $formationRepository->findBy([], ['id' => 'DESC']);
         }
         Else{
            $formation = $formationRepository->findAll();   

         }
         return $this->render('formation/index.html.twig', [
            //'formations' => $formationRepository->findAll(),
            'formations' => $formation,
         ]);

    }

    /**
     * @Route("/new", name="formation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $formation = new Formation();
        $formation->setDateVisite(new DateTime());
        //dump($formation);
        $form = $this->createForm(Formation1Type::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formation);
            $entityManager->flush();

            $this
            ->get('session')->getFlashBag()
            ->add('success', "Votre demande a été soumise!");

            //return $this->redirectToRoute('formation_index', [], Response::HTTP_SEE_OTHER);
            return $this->redirectToRoute('structure');
           // return $this->redirect('https://fonctionpublique.sec.gouv.sn/');
        }

        return $this->render('formation/new.html.twig', [
            'formation' => $formation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="formation_show", methods={"GET"})
     */
    public function show(Formation $formation): Response
    {
        return $this->render('formation/show.html.twig', [
            'formation' => $formation,
//            'thematique' => $thematique,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="formation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Formation $formation): Response
    {
        $form = $this->createForm(Formation1Type::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('formation/edit.html.twig', [
            'formation' => $formation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="formation_delete", methods={"POST"})
     */
    public function delete(Request $request, Formation $formation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formation_index', [], Response::HTTP_SEE_OTHER);
    }
}
