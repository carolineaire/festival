<?php

namespace App\Form;

use App\Entity\Comment;
use App\Entity\Media;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('content', TextareaType::class, [
            'attr' => [
                'placeholder' => 'Ecrivez votre commentaire ici...',
                'rows' => 5, //Nombre de ligne du textarea
                'style' => 'width: 100%;' //Assure au textarea d'occuper toute la largeur de la colonne
            ],
            'label' => false //Masquer le label
        ])
        ->add('save', SubmitType::class, [
            'label' => 'Envoyer',
            'attr' => [
                'class' => 'btn btn-sm btn-primary mt-3' //Styliser le bouton envoyer
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => Comment::class,
        ]);
    }
}
