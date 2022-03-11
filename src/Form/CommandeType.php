<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\CommandeStatut;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('designation')
            ->add('dateLivrReelle', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required' => false
            ])
            ->add('dateLivrEstimee', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required' => false
            ])
            ->add('montantHT')
            ->add('client',
            EntityType::class,[
                'class' => Client::class,
                'choice_label' => 'nom',
            ]
        )
            ->add('statut',
                EntityType::class,[
                    'class' => CommandeStatut::class,
                    'choice_label' => 'designation',
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
