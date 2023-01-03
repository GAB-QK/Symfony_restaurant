<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface as FormFormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
  public function buildForm(FormFormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('prenom', TextType::class, ['label' => 'prenom de l Utilisateurs '])
      ->add('nom', TextType::class, ['label' => 'nom de l Utilisateurs '])
      ->add('email', EmailType::class, ['label' => 'email de la Utilisateurs '])
      ->add('username', TextType::class, ['label' => 'Nom de la Utilisateurs '])
      ->add('password', TextType::class, ['label' => 'password de la Utilisateurs ']);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => User::class,
    ]);
  }
}
