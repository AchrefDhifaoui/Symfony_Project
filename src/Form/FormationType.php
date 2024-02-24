<?php

namespace App\Form;

use App\Entity\Formateur;
use App\Entity\Formation;
use App\Entity\secteur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titre')
            ->add('sousTitre')
            ->add('detail', TextareaType::class)
            ->add('objectifs',TextareaType::class)
            ->add('contenu', TextareaType::class)
            ->add('mode', ChoiceType::class, [
                'choices' => [
                    'Présentiel' => 'presentiel',
                    'En ligne' => 'en ligne',
                ],
                'expanded' => true,
                'required' => true,
            ])
            ->add('duree')
            ->add('prixUnitaire')
            ->add('unite', ChoiceType::class, [
                'choices' => [
                    'jour' => 'jour',
                    'heure' => 'heure',

                ],
                'expanded' => true,
                'required' => true,
            ])
            ->add('formateurs', EntityType::class, [
                'class' => Formateur::class,
'choice_label' => 'name',
'multiple' => true,
            ])
            ->add('secteur', EntityType::class, [
                'class' => secteur::class,
'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
