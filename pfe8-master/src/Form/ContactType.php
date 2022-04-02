<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname',TextType::class,[
                'attr' =>[
                    'placeholder'=>'Quel votre nom?'
                ]
            ])
            ->add('lastname',TextType::class,[
                'attr' =>[
                    'placeholder'=>'Quel votre prenom?'
                ]
            ])
            ->add('phone')
            ->add('email')
            ->add('message')
            ->add('Envouyer',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
