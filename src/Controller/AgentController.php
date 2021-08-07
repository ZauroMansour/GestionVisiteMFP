<?php

namespace App\Controller;

use App\Entity\Visite;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AgentController extends AbstractController
{
    /**
     * @Route("/agent", name="agent")
     */
    public function index()
    {
        $visite_repo = $this->getDoctrine()->getRepository(Visite::class);
        $visites = $visite_repo->findAll();
        return $this->render('agent/index.html.twig', [
            'controller_name' => 'AgentController',
            'visites' => $visites
        ]);
    }
}
