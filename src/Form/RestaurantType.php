<?php

namespace App\Form;

use App\Entity\Restaurant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[Vich\Uploadable]
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
            ]);
        // ->add('coverfile', VichImageType::class, [
        //     'label' => 'Image (JPG or PNG file)',
        //     'required' => false,
        //     'allow_delete' => true,
        //     'delete_label' => 'Delete ?',
        //     'download_uri' => false,
        //     'imagine_pattern' => 'squared_thumbnail_small',
        // ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Restaurant::class,
        ]);
    }
}
