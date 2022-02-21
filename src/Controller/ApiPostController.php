<?php

namespace App\Controller;

use App\Entity\AgentEtat;
use App\Entity\Image;
use App\Entity\Reclamation;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiPostController extends AbstractController
{
    /**
     * @Route("/api/agentetat", name="agentetat", methods={"POST"})
     */
    public function agent(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator)
    {
        $jsonRecu = $request->getContent();

        try {
            $agent = $serializer->deserialize($jsonRecu, AgentEtat::class, 'json');
            $agent->setDateDemande(new DateTime());
            $agent->setDatetraitement(new DateTime());

            $errors = $validator->validate($agent);
            if(count($errors) > 0){
                return $this->json($errors, 400);
            }
             // On récupère les images transmises
            //  $images = $agent->get('images')->getData();

            //  // On boucle sur les images
            //  foreach($images as $image){
            //      // On génère un nouveau nom de fichier
            //      $fichier = md5(uniqid()) . '.' . $image->guessExtension();
 
            //      // On copie le fichier dans le dossier uploads
            //      $image->move(
            //          $this->getParameter('images_directory'),
            //          $fichier
            //      );
 
            //      // On stocke l'image dans la base de données (son nom)
            //      $img = new Image();
            //      $img->setName($fichier);
            //      $agent->addImage($img);
            // }

            $em->persist($agent);
            $em->flush();

            return $this->json($agent, 201, [], ['groups' => 'agent:read']);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
        
    }
}
