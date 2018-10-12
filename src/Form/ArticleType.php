<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;


class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('auteur', ChoiceType::class, array(
                'choices' => array(
                    'Maxime CONSTANTIN'      => 'Maxime CONSTANTIN',
                    'Elodie ROUEL' => 'Elodie ROUEL',
                    'Julie TATIBOUET' => 'Julie TATIBOUET',
                    'Florian BRETON' => 'Florian BRETON',
                )                
            ))
            ->add('titre')
            ->add('resume')
            ->add('contenu', CKEditorType::class)
            ->add('altImage')
            ->add('image', FileType::class, array(
                'required' => false,
            ))
            ->add('save',      SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
