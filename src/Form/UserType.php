<?php

namespace App\Form;

use App\Entity\User;
use DateTime;
use Doctrine\DBAL\Types\DateTimeType;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Text;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('name')
            ->add('email', EmailType::class)
            // ->add('roles')
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Password',
                'constraints' =>[
                    new Length(['min'=> 8,
                    'minMessage'=>"Please enter a password of more than 8 characters",
                    'max' => 20,
                    'maxMessage'=>"Please enter a password of more let 20 characters"
                ]),
                ]
            ],
                'second_options' => ['label' => 'Confirm Password']

            ])
            
            ->add('phone', TextType::class, ['attr'=> ['pattern'=>'[0]{1}[0-9]{9}']])
            ->add('address', TextType::class)
            ->add('save', SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
