<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\State;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('server', EntityType::class, [
                'class' => 'App\Entity\Server',
                'choice_label' => 'name',
            ])
        ;
    }

   public function getParent()
   {
       return 'FOS\UserBundle\Form\Type\RegistrationFormType';
   }
   public function getBlockPrefix()
   {
       return 'app_user_registration';
   }
   public function getName()
   {
       return $this->getBlockPrefix();
   }
}
