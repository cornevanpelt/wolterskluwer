<?php

declare(strict_types = 1);

namespace App\Form;

use App\Entity\Bottom;
use App\Entity\Branch;
use App\Entity\Topping;
use App\Form\Model\Order;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('branch', EntityType::class, ['class' => Branch::class, 'choice_label' => 'name'])
            ->add('bottom', EntityType::class, ['class' => Bottom::class, 'choice_label' => 'name'])
            ->add('topping', EntityType::class, ['class' => Topping::class, 'choice_label' => 'name']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
                                   'csrf_field_name' => '_token',
                                   'data_class' => Order::class
                               ]);
    }
}