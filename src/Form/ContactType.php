<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Nom · 姓名', 
                'attr' => ['placeholder' => 'Enter your name'], 
                //'attr' => ['class' => 'file-input'],         
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Email · 电子邮件',
                'attr' => ['placeholder' => 'Enter your email'], 
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'Numéro · 数字',
                'attr' => ['placeholder' => '+33 ou 06/07'], 
                'constraints' => [
                    new Regex([
                        'pattern' => '/^(\+33|0)[1-9]([-. ]?[0-9]{2}){4}$/',
                        'message' => 'Veuillez entrer un numéro de téléphone valide.',
                    ]),
                ],
            ])
            ->add('message', TextareaType::class, [
                'required' => true,
                'label' => 'Message · 信息',
                'attr' => ['placeholder' => 'Enter your message'], 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
