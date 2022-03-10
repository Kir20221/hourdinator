<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\ArticleCategorie;
use App\Entity\ClientCategorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
//            ->add('code')
            ->add('designation')
            ->add('prix')
            ->add('categorie',
                EntityType::class,[
                    'class' => ArticleCategorie::class,
                    'choice_label' => 'nom',
                ]
            )
            ->add('achetablePar',
                EntityType::class,[
                    'class' => ClientCategorie::class,
                    'choice_label' => 'nom',
                    'multiple' => true
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
