<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface as FormFormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserUpdateType extends AbstractType
{
  public function buildForm(FormFormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('prenom', TextType::class, ['label' => ' '])
      ->add('nom', TextType::class, ['label' => ' '])
      ->add('email', EmailType::class, ['label' => ' '])
      ->add('username', TextType::class, ['label' => ' ']);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => User::class,
    ]);
  }
}
