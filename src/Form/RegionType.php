<?php

namespace App\Form;

use App\Entity\Region;
use App\Entity\TypeRegion;
use App\Entity\Server;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RegionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('x')
            ->add('y')
            ->add('TypeRegion', EntityType::class, [
                'class' => TypeRegion::class,
                'choice_label' => 'name',
            ])
            ->add('server', EntityType::class, [
                'class' => Server::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Region::class,
        ]);
    }
}
