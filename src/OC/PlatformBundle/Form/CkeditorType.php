<?php
/**
 * Created by PhpStorm.
 * User: philippetraon
 * Date: 27/10/2018
 * Time: 17:41
 */

namespace OC\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CkeditorType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'attr' => array('class' => 'ckeditor') // On ajoute la classe CSS
        ));
    }

    public function getParent() // On utilise l'héritage de formulaire
    {
        return TextareaType::class;
    }
}