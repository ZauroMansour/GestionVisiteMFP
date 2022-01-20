<?php

namespace App\Controller;

use App\Entity\MotifDemande;
use App\Entity\Service;
use App\Entity\Structure;
use App\Repository\MotifDemandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="structure")
     * @param Request $request
     * @return Response
     */
    public function structure(Request $request, MotifDemandeRepository $objet_demande_repo)
    {
        $structure_repo = $this->getDoctrine()->getRepository(Structure::class);
        $structures = $structure_repo->findAll();


        return $this->render('default/structures.html.twig', [
            'structures' => $structures,
            'objets' => $objet_demande_repo->findAll()
        ]);
    }

    /**
     * @Route("/structure/{id_structure}", name="service")
     * @param Request $request
     * @param $id_structure
     * @return Response
     */
    public function service(Request $request, $id_structure)
    {

        $structure_repo = $this->getDoctrine()->getRepository(Structure::class);
        $service_repo = $this->getDoctrine()->getRepository(Service::class);
        $services = $service_repo->findBy(['structure' => $id_structure]);

        return $this->render('default/service.html.twig', [
            'services' => $services,
            'structure' => $structure_repo->find($id_structure)
        ]);
    }

    /**
     * @Route("/demarches/{id_service}", name="demandeObject")
     * @param Request $request
     * @param $id_service
     * @return Response
     */
    public function demarche(Request $request, $id_service)
    {

        $demande_repo = $this->getDoctrine()->getRepository(MotifDemande::class);
        $demarches = $demande_repo->findBy(['service' => $id_service]);

        return $this->render('default/demarches.html.twig', [
            'demarches' => $demarches,
            'Idservice' => $id_service,
        ]);
    }
}
