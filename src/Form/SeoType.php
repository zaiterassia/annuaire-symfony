<?php

namespace App\Form;

use App\Entity\Seo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SeoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('annuary', null, ['label' => 'Annuaire'])
            ->add('site', null, ['label' => 'Site référencé'])
            ->add('response', ChoiceType::class, [
                'choices' => [
                    'Accepté' =>'oui' ,
                    'Rejeté'=> 'non'  ,
                    'En attente' => 'en attente' ,
                ],
                'label' => 'Réponse',
            ])
            ->add('username', null, ['label' => 'Identifiant/Email'])
            ->add('password', null, ['label' => 'Mot de passe'])
            ->add('responseUrl', null, ['label' => 'Lien retour'])
            ->add('observations', TextareaType::class, array(
                'required' => false,
                'label' => 'Observations',
                ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Seo::class,
        ]);
    }
}
