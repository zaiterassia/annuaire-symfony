<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', null, ['label' => 'Identifiant'])
            ->add('password', null, ['label' => 'Mot de passe'])
            ->add('firstname', null, ['label' => 'Nom'])
            ->add('lastname', null, ['label' => 'Prénom'])
            ->add('email', null, ['label' => 'Email'])
            ->add('admin', ChoiceType::class, [
                'choices' => [
                    'Administrateur' => 1  ,
                    'Utilisateur' => 0  ,
                ],
                'label' => 'Niveau droit',
            ])
            ->add('description', null, ['label' => 'Description'])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
