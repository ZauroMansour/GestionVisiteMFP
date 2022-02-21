<?php

namespace App\DataFixtures;

use App\Entity\Departement;
use App\Entity\MotifDemande;
use App\Entity\Service;
use App\Entity\User;
use App\Entity\Visite;
use App\Repository\ServiceRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
    private $entityManager;
    private $serviceRepository;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, ServiceRepository $serviceRepository)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager = $entityManager;
        $this->serviceRepository = $serviceRepository;
    }

//    public function load(ObjectManager $manager)
//    {
//        $departement_repo = $this->entityManager->getRepository(Departement::class);
//        $motif_repo = $this->entityManager->getRepository(MotifDemande::class);
//
//        for ($i = 0; $i < 5; $i++) {
//            $visite = new Visite();
//            $email = "visite".$i."@visite.com";
//            $visite->setEmail($email);
//            $visite->setAdresse('Fann');
//            $visite->setDateVisite(new \DateTime());
//            $visite->setDemande("Ceci est une demande ".$i);
//            $visite->setPrenomVisiteur("prenom visiteur ".$i);
//            $visite->setNomVisiteur("nom visiteur ".$i);
//            $visite->setTelephone(77670390);
//            $visite->setDepartement($departement_repo->find(1));
//            $visite->setMotifDemande($motif_repo->find(4));
//            $manager->persist($visite);
//            $manager->flush();
//        }
//    }


    public function load(ObjectManager $manager)
    {
            $user = new User();
            $nom = 'admin';
            $user->setPrenom($nom);
            $user->setNom($nom);
            $email = "admin@admin.com";
            $user->setEmail($email);
            $user->setService($this->serviceRepository->find(1));
            $user->setPassword($this->passwordEncoder->encodePassword(
                 $user,
                 'passer'
             ));
             $user->setUsern('admin');
             $user->setActive('1');
             $user->setRoles(['ROLE_ADMIN']);
            $manager->persist($user);
        $manager->flush();
    }
}