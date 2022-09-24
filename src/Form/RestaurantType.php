<?php

namespace App\Form;

use App\Entity\Restaurant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RestaurantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du restaurant'
            ])
            ->add('adress', TextType::class, [
                'label' => 'Adresse'
            ])
            ->add('tel', TextType::class, [
                'label' => 'Numéro de téléphone'
            ])
            ->add('website', TextType::class, [
                'label' => 'Site Web'
            ])
            ->add('cover')
            ->add('coverfile')
            ->add('created_at')
            ->add('updated_at');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Restaurant::class,
        ]);
    }
}
