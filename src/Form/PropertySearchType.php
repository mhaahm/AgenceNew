<?php

namespace App\Form;

use App\Entity\Options;
use App\Entity\PropertyType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('max_price',IntegerType::class,[
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Max price'
                ]
            ])
            ->add('min_surface',IntegerType::class,[
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Surface minimale'
                ]
            ])
            ->add('options',EntityType::class,[
                'required' => false,
                'label' => false,
                'class' =>Options::class,
                'choice_label'=>'name',
                'multiple' => true

            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertyType::class,
            'method' =>'get',
            'csrf_protection' => false
        ]);
    }

    public function  getBlockPrefix()
    {
        return '';
    }
}
