<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('phone', TextType::class)
            ->add('address', TextType::class)
            //->add('password')
            ->add('name', TextType::class)
            ->add('create_date', DateType::class)
            ->add('update_date', DateType::class)
            ->add('active')
            ->add('deleted')
            ->add('sorting')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'ROLE_USER' => null,
                    'ROLE_MANAGER' => null,
                    'ROLE_ADMIN' => null
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}