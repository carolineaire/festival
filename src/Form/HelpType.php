<?php

namespace App\Form;

use App\Entity\Help;
use Doctrine\DBAL\Types\DateType;
use PHPUnit\Framework\Constraint\IsTrue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType as TypeDateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue as ConstraintsIsTrue;

class HelpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstname', TextType::class, [
            'attr' => ['class' => 'form-control', 'placeholder' => 'Entrez votre prénom']
        ])
        ->add('lastname', TextType::class, [
            'attr' => ['class' => 'form-control', 'placeholder' => 'Entrez votre nom de famille']
        ])
        ->add('date', TypeDateType::class, [
            'widget' => 'single_text',
            'attr' => ['class' => 'form-control']
        ])
        ->add('email', EmailType::class, [
            'attr' => ['class' => 'form-control', 'placeholder' => 'Votre adresse email']
        ])
            ->add('skills', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Ecrivez votre commentaire ici...',
                    'rows' => 5,
                ],
                'label' => false,
            ])
            ->add('content', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Ecrivez votre commentaire ici...',
                    'rows' => 5,
                ],
                'label' => false,
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new ConstraintsIsTrue([
                        'message' => 'Vous devez accepter les conditions.',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Help::class,
        ]);
    }
}
