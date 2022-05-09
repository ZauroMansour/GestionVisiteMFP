<?php

namespace App\Form;

use App\Entity\Formation;
use App\Entity\Thematique;
use App\Entity\Ministere;
use Doctrine\DBAL\Types\TextType as TypesTextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
<<<<<<< HEAD
=======
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
>>>>>>> fc5a89a0af00c8a02c4908636a64e4846b943988
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Formation1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule')
            ->add('prenom')
            ->add('nom')
            ->add('telephone')
            ->add('email')
            // ->add('matricule', TextType::class, [
            //     'empty_data' => null,
            //     'label' => 'Votre Matricule:',
            //     'placeholder' => 'Saisissez Votre Matricule:',
            //     'required' => true,
            // ])
            ->add('formation', TextType::class, [
                'empty_data' => null,
                'label' => 'Votre fonction:',
                'required' => true,
            ])
            ->add('ministere', EntityType::class, [
                'label' => 'Ministère/Administration:',
                'class' => Ministere::class,
                'choice_label' => 'nom',
                'required' => true,
                'placeholder' => 'Choisissez votre structure',
            ])
            ->add('thematique', EntityType::class, [
                'label' => 'Choix thématiques:',
                'class' => Thematique::class,
                'choice_label' => 'libelle',
                'required' => true,
                'placeholder' => "Choisir votre thématique",
                'expanded' => true,
                'multiple' => true,
            ])
             ->add('save', SubmitType::class, [
                 'label' => 'Enregistrer'
             ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
