<?php

namespace App\Form;

use App\Entity\AgentEtat;
use App\Entity\Reclamation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgentEtatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('idAgent', TextType::class, [
            'empty_data' => '',
            'label' => 'Id agent:',
            'required' => true
        ])
        ->add('matricule', TextType::class, [
            'empty_data' => null,
            'label' => 'Matricule agent:',
            'required' => true
        ])
        ->add('cni', TextType::class, [
            'empty_data' => null,
            'label' => 'CIN agent:',
            'required' => true
        ])
        ->add('nom', TextType::class, [
            'empty_data' => '',
            'label' => 'Nom Agent:',
            'required' => true
        ])
        ->add('prenom', TextType::class, [
            'empty_data' => '',
            'label' => ' Prenom: agent',
            'required' => true
        ])
        ->add('datenaiss', DateType::class, array(
            'label' => 'Date de naissance agent:',
            'required' => true,
            'widget' => 'single_text',
            'empty_data' => date("now")
        ))
        ->add('corps', TextType::class, [
            'empty_data' => null,
            'label' => 'Libellé corps agent',
            'required' => true
        ])
        ->add('telephone', TextType::class, [
            'empty_data' => '',
            'label' => 'Téléphone agent:',
            'required' => true
        ])
        ->add('email', EmailType::class,[
            'empty_data' => '',
            'label' => 'Email agent:',
            'required' => true
        ])

        ->add('adresse', TextareaType::class, [
            'label' => 'Adresse agent:'
        ])
        // ->add('reclamations', EntityType::class, [
        //     'label' => 'Motif reclamation:',
        //     'class' => Reclamation::class,
        //     'choice_label' => 'libelle',
        //     'required' => true,
        //     'placeholder' => "Motif(s) réclamation",
        //     'expanded' => true,
        //     'multiple' => true,
        // ])
        ->add('demande', TextareaType::class, [
            'empty_data' => '',
            'label' => 'Description de la demande:'
        ])
        ->add('reponse', TextareaType::class, [
            'empty_data' => '',
            'label' => 'réponse de la demande:'
        ])
        ->add('images', FileType::class, [
            'label' => false,
            'multiple' => true,
            'mapped' => false,
            'required' => false
        ])
        // ->add('CNIname', FileType::class, [
        //     'label' => 'Piéce justificative',
        //     'mapped' => false,
        //     'required' => true,
        //     'constraints' => [
        //         new EOTFile([
        //             'maxSize' => '4096k',
        //             'mimeTypes' => [
        //                  'application/pdf',
        //                  'application/x-pdf',
        //                  'image/jpeg',
        //                  'image/png',
        //                  'image/gif',
        //            ],
        //            'mimeTypesMessage' => "Merci d'uploader un fichier de type image ou PDF!"
        //         ])
        //     ],
        // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AgentEtat::class,
        ]);
    }
}
