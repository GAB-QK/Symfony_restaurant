<?php

namespace App\Form;

use App\Entity\Dessert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface as FormFormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DessertType extends AbstractType
{
    public function buildForm(FormFormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TypeTextType::class, ['label' => ' '])
            ->add('price', NumberType::class, ['label' => ' ']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dessert::class,
        ]);
    }
}
