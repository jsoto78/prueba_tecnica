<?php

namespace App\Form;

use App\Entity\Country;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CountryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('full_name')
            ->add('code')
            ->add('currency')
            ->add('language')
            ->add('capital_city')
            ->add('flag')
            ->add('map')
            ->add('population')
            ->add('area')
            ->add('region')
            ->add('sub_region')
            ->add('Save',SubmitType::class,['attr' => ['class'=>'btn btn-light float-end']])
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Country::class,
        ]);
    }
}
