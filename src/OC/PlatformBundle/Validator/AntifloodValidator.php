<?php
/**
 * Created by PhpStorm.
 * User: leazygomalas
 * Date: 27/10/2018
 * Time: 12:17
 */

namespace OC\PlatformBundle\Validator;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class AntifloodValidator extends ConstraintValidator
{
    private $requestStack;
    private $em;

    // Les arguments déclarés dans la définition du service arrivent au constructeur
    // On doit les enregistrer dans l'objet pour pouvoir s'en resservir dans la méthode validate()
    public function __construct(RequestStack $requestStack, EntityManagerInterface $em)
    {
        $this->requestStack = $requestStack;
        $this->em           = $em;
    }


    public function validate($value, Constraint $constraint)
    {
        // Pour récupérer l'objet Request tel qu'on le connait, il faut utiliser getCurrentRequest du service request_stack
        $request = $this->requestStack->getCurrentRequest();

        // On récupère l'IP de celui qui poste
        $ip = $request->getClientIp();

        // On vérifie si cette IP a déjà posté une candidature il y a moins de 15 secondes
        $isFlood = $this->em
            ->getRepository('OCPlatformBundle:Application')
            ->isFlood($ip, 15) // Bien entendu, il faudrait écrire cette méthode isFlood, c'est pour l'exemple
        ;

        // Pour l'instant, on considère comme flood tout message de moins de 3 caractères
        if ($isFlood) {
            // C'est cette ligne qui déclenche l'erreur pour le formulaire, avec en argument le message de la contrainte
            $this->context->addViolation($constraint->message);
        }
    }
}