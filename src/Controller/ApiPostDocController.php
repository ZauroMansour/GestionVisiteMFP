<?php
namespace App\Controller;

use App\Entity\Image;
use App\Entity\AgentEtat;
use App\Repository\AgentRepository;
use App\Repository\AgentEtatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ApiPostDocController extends AbstractController
{
    /**
     * @Route("/api/document/store", name="api_document_store", methods={"POST"})
     */
    public function store(Request $request, AgentEtatRepository $agentRepo, EntityManagerInterface $em)
    {
        // dd($request);
        $monFichier = $request->files->get('filename');
        $idReclam = $request->request->get('id');
        //dd($monFichier[0]->getClientOriginalExtension());
        $ind = 0;
        $errors = [];
        if ($monFichier) {
            foreach($monFichier as $mn){
                if ($mn) {
                    try {
                        //$idAgent = explode("_", $mn->getClientOriginalName())[0];
                        $agent = $agentRepo->find($idReclam);
                        if ($agent) {
                            if ($mn->move($this->getParameter('piecejointe'), "pj".$idReclam."_".$ind.".".$mn->getClientOriginalExtension())) {
                                $image = new Image();
                                $image->setPiecesjointes($agent);
                                $image->setName("pj".$idReclam."_".$ind.".".$mn->getClientOriginalExtension());
                                $em->persist($image);
                                $em->flush();
                            }else{
                                $errors = "Fichier non déplacé";
                            }
                        }else{
                            $errors = "Cet id reclamation est absent dans notre base de données";
                            return $this->json([
                                    'status' => 400,
                                    'message' => 'Cet id reclamation est absent dans notre base de données'
                                ], 400);
                        }    
                    } catch (FileException $e) {
                        return $this->json([
                                'status' => 400,
                                'message' => $e->getMessage()
                            ], 400);
                    } 
                }
                $ind +=0;
            }
        }else {
            return $this->json([
                        'status' => 403,
                        'message' => 'aucun fichier recu'
                    ], 403);
        }    
        if(count($errors) > 0){
            return $this->json([
                'status' => 403,
                'message' => 'Upload echoue'
            ], 403);
        }else{
            return $this->json([
                'status' => 201,
                'message' => 'Upload reussi'
            ], 201);
        }

    }
}