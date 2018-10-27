<?php

namespace OC\PlatformBundle\Form;

use OC\PlatformBundle\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvertType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Arbitrairement, on récupère toutes les catégories qui commencent par "D"
        $pattern = 'D%';

        $builder
            ->add('date', DateTimeType::class)
            ->add('title', TextType::class)
            ->add('author', TextType::class)
            ->add('content', TextareaType::class)
            ->add('published', CheckboxType::class, array('required' => false))
            //->add('categories', SubmitType::class)
            ->add('image',     ImageType::class) // Ajoutez cette ligne
            /*
             * Rappel :
             ** - 1er argument : nom du champ, ici « categories », car c'est le nom de l'attribut
             ** - 2e argument : type du champ, ici « CollectionType » qui est une liste de quelque chose
             ** - 3e argument : tableau d'options du champ
            */
            /*->add('categories', CollectionType::class, array(
                'entry_type'   => CategoryType::class,
                'allow_add'    => true,
                'allow_delete' => true
            ))*/
            ->add('categories', EntityType::class, array(
                'class'        => 'OCPlatformBundle:Category',
                'choice_label' => 'name',
                'multiple'     => true,
                'query_builder' => function(CategoryRepository $repository) use($pattern) {
                    return $repository->getLikeQueryBuilder($pattern);
                }
            ))
            ->add('save',      SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\PlatformBundle\Entity\Advert'
        ));
    }
}
