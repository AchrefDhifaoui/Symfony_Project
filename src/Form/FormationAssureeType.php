<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Formateur;
use App\Entity\Formation;
use App\Entity\FormationAssuree;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationAssureeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDebut', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('unite', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('qte', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('formateur', EntityType::class, [
                'class' => Formateur::class,
                'attr' => ['class' => 'form-control']
            ])
            ->add('client', EntityType::class, [
                'class' => Client::class,
'choice_label' => 'id','attr' => ['class' => 'form-control']
            ])
            ->add('Formation', EntityType::class, [
                'class' => Formation::class,
'choice_label' => 'id','attr' => ['class' => 'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FormationAssuree::class,
        ]);
    }
}
