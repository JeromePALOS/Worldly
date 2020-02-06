<?php

namespace App\Form;

use App\Entity\StateRegion;
use App\Entity\State;
use App\Entity\Region;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class StateRegionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if($options['role'] == 1){
            $builder
                ->add('state', EntityType::class, [
                    'class' => State::class,
                    'choice_label' => 'name',
                ]);
        }
        $builder
            ->add('region', EntityType::class, [
                'class' => Region::class,
                'choice_label' => function ($region) {
                    return '(' . $region->getY() . ', ' . $region->getX() . ')';
                },
                'placeholder' => '(x, y)'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined(['role']);
               
        $resolver->setDefaults([
            'role'     => 0,
        ]);

        
        $resolver->setDefaults([
            'data_class' => StateRegion::class,
        ]);
    }
}
