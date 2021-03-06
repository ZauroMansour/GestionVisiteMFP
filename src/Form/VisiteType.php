<?php

namespace App\Form;

use App\Entity\Departement;
use App\Entity\MotifDemande;
use App\Entity\Region;
use App\Entity\Service;
use App\Entity\Structure;
use App\Entity\Visite;
use App\Repository\MotifDemandeRepository;
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

class VisiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $service_id = $options['service_id'];
        $edit = $options['edit'];
        $builder
            ->add('nom_visiteur', TextType::class, [
                'empty_data' => '',
                'label' => 'Votre nom:',
                "disabled" => $edit
            ])
            ->add('prenom_visiteur', TextType::class, [
                'empty_data' => '',
                'label' => 'Votre prenom:',
                "disabled" => $edit
            ])
            ->add('adresse', TextType::class, [
                'empty_data' => '',
                'required' => false,
                'label' => 'Votre adresse:',
                "disabled" => $edit
            ])
            ->add('datenaiss', DateType::class, array(
                'label' => 'Date de naissance:',
                'required' => false,
                'widget' => 'single_text',
                'empty_data' => date("now"),
               // "disabled" => $edit
            ))
            ->add('lieunaiss', TextType::class, [
                'empty_data' => null,
                'label' => 'Lieu de Naissance:',
                'required' => true,
                //"disabled" => $edit
            ])
            ->add('matricule', TextType::class, [
                'empty_data' => null,
                'label' => 'Votre matricule:',
                "disabled" => $edit
            ])
            ->add('profession', TextType::class, [
                'empty_data' => null,
                'label' => 'Votre profession:',
                'required' => true,
                "disabled" => $edit
            ])
            ->add('cin', TextType::class, [
                'empty_data' => '',
                'label' => 'Num??ro d\'identit?? nationale:',
                'required' => true,
                // 'constraints'   =>  new Regex([
                //     'pattern' => "/^(^(^(\d{1}([a-z]|\d{1})\d{11})$|\d{14}$)|[a-z]\d{8})$/i",
                //     'message'   =>  "Le num??ro saisi n'est pas valide, v??rifiez qu'il s'agit bien du numero court derri??re la carte"
                // ]),
               // "disabled" => $edit
            ])
            ->add('CNIname', FileType::class, [
                'label' => 'Scanne de la CIN',
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '4096k',
                        'mimeTypes' => [
                             'application/pdf',
                             'application/x-pdf',
                             'image/jpeg',
                             'image/png',
                             'image/gif',
                       ],
                       'mimeTypesMessage' => "Merci d'uploader un fichier de type image ou PDF!"
                    ])
                ],
            ])
            ->add('demande', TextareaType::class, [
                'empty_data' => '',
                'label' => 'Decrivez votre demande:',
                'required' => false,
                "disabled" => $edit
            ])
            ->add('telephone', TextType::class, [
                'empty_data' => '',
                'label' => 'Numero t??l??phone:',
                'required' => true,
                "disabled" => $edit
            ])
            ->add('genre', ChoiceType::class, array(
                'empty_data' => 'ok',
                'placeholder' => 'Selectionner votre sexe',
                'choices' => array('Masculin' => 'Masculin', 'F??minin' => 'Feminin'),
                'label' => 'Votre Sexe: ',
                'required' => true,
                'expanded' => true
                ))
            ->add('motifDemande', EntityType::class, [
                'label' => "Objet de la demarche:",
                'class' => MotifDemande::class,
                'choice_label' => 'libelle',
                'placeholder' => 'Objet de la demande',
                'query_builder' => function (MotifDemandeRepository $demandeRepository) use ($service_id) {
                    return $demandeRepository->findMotifbyService($service_id);
                },
            ])
            ->add('region', EntityType::class, [
//                'mapped' => false,
                'label' => 'R??gion de r??sidence:',
                'class' => Region::class,
                'choice_label' => 'libelle',
                'required' => false,
                'placeholder' => 'Choisir votre r??gion de r??sidence',
            ])
            ->add('reponse', TextareaType::class, [
                'label' => 'La r??ponse:'
            ])
            ->add('structure', EntityType::class, [
                'label' => 'La structure:',
                'class' => Structure::class,
                'choice_label' => 'nom',
                'required' => true,
                'placeholder' => 'Structure',
            ]);
        if (!$edit) {
            $builder->add('email', RepeatedType::class, [
                'type' => EmailType::class,
                'empty_data' => '',
                'invalid_message' => 'les deux emails doivent ??tre identiques.',
                'required' => true,
                'first_options'  => ['label' => 'Votre adresse email:'],
                'second_options' => ['label' => 'R??p??tez votre email:'],
            ]);
        }
        $builder->get('region')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $this->addDepartementField($form->getParent(), $form->getData());
            }
        );
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
                /* @var $departement Departement */
                // On r??cup??re le d??partement et la r??gion
                $departement = $data->getDepartement();
                if ($departement != null) {
                    $region = $departement->getRegion();
                    // On cr??e le champs departement
                    $this->addDepartementField($form, $region);
                    // On set les donn??es
                    $form->get('region')->setData($region);
                    $form->get('departement')->setData($departement);
                } else {
                    // On cr??e le champs departement en le laissant vide (champs utilis?? pour le JavaScript)
                    $this->addDepartementField($form, null);
                }
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
                    // On set les donn??es
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

    private function addDepartementField(FormInterface $form, ?Region $region)
    {
        $placeholder = $region
            ? 'S??lectionnez votre d??partement de r??sidence'
            : 'S??lectionnez votre r??gion de r??sidence';
        $form->add('departement', EntityType::class, [
            'class' => Departement::class,
            'label' => 'Departement de r??sidence',
            'placeholder' => $placeholder,
            'choices' => $region ? $region->getDepartements() : [],
            'required' => false,
        ]);
    }

    private function addServiceField(FormInterface $form, ?Structure $structure)
    {
        $placeholder = $structure
            ? 'S??lectionnez le service'
            : 'S??lectionnez la structure';
        $form->add('service', EntityType::class, [
            'class' => Service::class,
            'label' => 'Service:',
            'placeholder' => $placeholder,
            'choices' => $structure ? $structure->getServices() : [],
            'required' => false,
        ]);
    }
}
