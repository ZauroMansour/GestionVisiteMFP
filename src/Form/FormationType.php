<?php

namespace App\Form;

use App\Entity\Departement;
use App\Entity\MotifDemande;
use App\Entity\Region;
use App\Entity\Service;
use App\Entity\Structure;
use App\Entity\Thematique;
use App\Entity\Ministere;
use App\Entity\Visite;
use App\Repository\MotifDemandeRepository;
use PhpParser\Parser\Multiple;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use function date;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $service_id = $options['service_id'];
        $edit = $options['edit'];
        $builder
            ->add('matricule', TextType::class, [
                'empty_data' => null,
                'label' => 'Votre matricule:',
                'required' => true,
                "disabled" => $edit
            ])
            ->add('nom_visiteur', TextType::class, [
                'empty_data' => '',
                'label' => 'Votre nom:',
                'required' => true,
                "disabled" => $edit
            ])
            ->add('prenom_visiteur', TextType::class, [
                'empty_data' => '',
                'label' => 'Votre prenom:',
                'required' => true,
                "disabled" => $edit
            ])
            ->add('profession', TextType::class, [
                'empty_data' => null,
                'label' => 'Votre fonction:',
                'required' => true,
                "disabled" => $edit
            ])
            ->add('telephone', TextType::class, [
                'empty_data' => '',
                'label' => 'Numero téléphone:',
                'required' => true,
                "disabled" => $edit
            ])
            ->add('email', EmailType::class,[
                'empty_data' => '',
                'label' => 'Votre adresse email:',
                'required' => true,
                "disabled" => $edit
            ])
            ->add('thematique', ChoiceType::class, array(
                'empty_data' => null,  
                'choice_filter' => array(
                  "L'art de communiquer" => "L'art de communiquer",
                  "La gestion de projet (succès et échec)" => "La gestion de projet (succès et échec)",
                  "Prenez votre vie en main!" => "Prenez votre vie en main!"),
                  'expanded' => true,
                  'multiple' => true, 
                 ))
            
            ->add('ministere', EntityType::class, [
                'label' => 'Ministère/Administration:',
                'class' => Ministere::class,
                'choice_label' => 'nom',
                'required' => true,
                'placeholder' => 'Choisir votre ministere',
            ])
            // ->add('motifDemande', EntityType::class, [
            //     'label' => "Objet de la demarche:",
            //     'class' => MotifDemande::class,
            //     'choice_label' => 'libelle',
            //     'required' => false,
            //     'placeholder' => 'Objet de la demande',
            //     'query_builder' => function (MotifDemandeRepository $demandeRepository) use ($service_id) {
            //         return $demandeRepository->findMotifbyService($service_id);
            //     },
            // ])
            ->add('structure', EntityType::class, [
                'label' => 'La structure:',
                'class' => Structure::class,
                'choice_label' => 'nom',
                'required' => false,
                'placeholder' => 'Structure',
            ]);

        $builder->get('structure')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $this->addServiceField($form->getParent(), $form->getData());
            }
        );

        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event) {
                $data = $event->getData();
                $form = $event->getForm();
                /* @var $service Service */
                $service = $data->getService();
                if ($service != null) {
                    $structure = $service->getStructure();
                    $this->addServiceField($form, $structure);
                    // On set les données
                    $form->get('structure')->setData($structure);
                    $form->get('service')->setData($service);
                } else {
                    $this->addServiceField($form, null);
                }
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => Visite::class,
            ])
            ->setRequired([
                'service_id'
            ])
            ->setRequired([
                'edit'
            ]);
    }

    private function addServiceField(FormInterface $form, ?Structure $structure)
    {
        $placeholder = $structure
            ? 'Sélectionnez le service'
            : 'Sélectionnez la structure';
        $form->add('service', EntityType::class, [
            'class' => Service::class,
            'label' => 'Service:',
            'placeholder' => $placeholder,
            'choices' => $structure ? $structure->getServices() : [],
            'required' => false,
        ]);
    }
}
