<?php

namespace App\Form;

use App\Entity\AgentEtat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgentEtat1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idAgent')
            ->add('nom')
            ->add('prenom')
            ->add('datenaiss')
            ->add('matricule')
            ->add('cni')
            ->add('email')
            ->add('telephone')
            ->add('adresse')
            ->add('demande')
            ->add('datedemande')
            ->add('corps')
            ->add('reclamations')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AgentEtat::class,
        ]);
    }
}
