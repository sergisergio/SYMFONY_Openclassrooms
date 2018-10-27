<?php
/**
 * Created by PhpStorm.
 * User: leazygomalas
 * Date: 27/10/2018
 * Time: 12:16
 */

namespace OC\PlatformBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Antiflood extends Constraint
{
    public $message = "Vous avez déjà posté un message il y a moins de 15 secondes, merci d'attendre un peu.";
    // Puis ajouter la contrainte @Antiflood(message="Mon message personnalisé")

    public function validatedBy()
    {
        return 'oc_platform_antiflood'; // Ici, on fait appel à l'alias du service
    }
}