<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\Tournois;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SupprTnoisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('tournois', EntityType::class, [
            'class' => Tournois::class,
            'choice_label' => function ($tournois) {
                return $tournois->getNom() . ' - ' . $tournois->getEv()->getNom();
            },
            'multiple' => true,
        ])
        ->add('save', SubmitType::class, ['label' => 'Enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        ]);
    }
}
