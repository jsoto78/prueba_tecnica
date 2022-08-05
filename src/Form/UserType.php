<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class,['attr' => ['autocomplete'=>'off']])
        ->add('email', EmailType::class)
        ->add('roles', ChoiceType::class, array(
            'attr'  =>  array('class' => 'form-control',
            'style' => 'margin:5px 0;'),
            'choices' => 
            array
            (
                'ROLE_ADMIN' => array
                (
                    'Yes' => 'ROLE_ADMIN',
                ),
                'ROLE_USER' => array
                (
                    'Yes' => 'ROLE_USER'
                ),
            ) 
            ,
            'multiple' => true,
            'required' => true,
            )
        )
        ->add('password', PasswordType::class)
        ->add('Save',SubmitType::class,['attr' => ['class'=>'btn btn-light float-end']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

}
