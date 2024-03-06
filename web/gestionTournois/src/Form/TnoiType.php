<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\Tournois;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class TnoiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',null,['label'=> 'Nom  '])
            ->add('description', null ,['label'=> 'Description  '])
            ->add('ev', EntityType::class, [
                'class' => Evenement::class,
                'choice_label' => 'nom',
                'label' => false
            ])
            ->add('save', SubmitType::class, ['label' => 'Enregistrer']);

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tournois::class,
        ]);
    }
}
