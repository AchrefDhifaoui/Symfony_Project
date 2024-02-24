<?php

namespace App\Form;

use App\Entity\ParametreIota;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParametreIotaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('adresse', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('email', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('tel', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('fax', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('mf', null, [
                'attr' => ['class' => 'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ParametreIota::class,
        ]);
    }
}
