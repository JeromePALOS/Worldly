<?php

namespace App\Form;

use App\Entity\State;
use App\Entity\Region;
use App\Repository\RegionRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class StateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',     			TextType::class)
            ->add('description',        TextareaType::class)
            ->add('color',              ColorType::class)
            ->add('language',           LanguageType::class, [
                 'data' => 'fr'    
                
            ])
            /**->add('stateRegions',        EntityType::class, [
                'class' => Region::class,
                'query_builder' => function (RegionRepository $er) {
                    return $er->createQueryBuilder('r')
                        ->where('r.spawnable = 1');
                },
                
                'choice_label' => function ($region) {
                    return '(' . $region->getY() . ', ' . $region->getX() . ')';
                },
                'placeholder' => '(x, y)',
                'label' => 'First Region',
                'required' => true
            ])**/
        ;
        
        
        if($options['role'] == 1){
            $builder
                ->add('statut',				ChoiceType::class, 
                    array(
                        'choices'  => array(
                            'Validate' => "Validate",
                            'Refuse' => "Refuse",
                            'Awaiting' => "Awaiting",
                            'Destroy' => "Destroy",
                        ), 
                    )
                )
            ;
        }
        
        
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired(['role']);
        $resolver->setDefaults([
            'data_class' => State::class,
        ]);
    }
}