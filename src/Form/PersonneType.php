<?php

namespace App\Form;

use App\Entity\Hobby;
use App\Entity\Job;
use App\Entity\Personne;
use App\Entity\Profile;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname')
            ->add('name')
            ->add('age')

            ->add('profile', EntityType::class, [
                'class' => Profile::class,
                'expanded'=>false,
                'attr'=> [
                    'class'=>'select2'
                ],

                'required'=>false
            ])
            ->add('hobbies', EntityType::class, [
                'class' => Hobby::class,

                'required'=>false,
                'expanded'=>false,
                'multiple' => true,
                'query_builder'=>function (EntityRepository $er) {
                return $er->createQueryBuilder('h')
                    ->orderBy('h.designation','ASC');

                },
                'attr'=> [
                    'class'=>'select2'
                ],

            ])
            ->add('job', EntityType::class, [
                'class' => Job::class,

                'required'=>false,
                'attr'=> [
                    'class'=>'select2'
                ],

'choice_label' => 'designation',
            ])
            ->add('photo',FileType::class,[
                'label'=>'votre image de prodile(des fichier uniquement',
                'mapped'=>false,
                'required'=>false,
                'constraints'=>[
                    new File([
                        'maxSize'=>'1024k',
                        'mimeTypes'=>[
                            'image/gif',
                            'image/jpeg',
                            'image/jpg',
                        ],
                        'mimeTypesMessage'=>'please upload a valid PDF document',
                    ])
                ],
            ])
            ->add('aditer',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personne::class,
        ]);
    }
}
