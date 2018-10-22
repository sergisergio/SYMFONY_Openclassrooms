<?php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * Note: ajout de @ devant le bundle et suppression du suffixe Bundle après OCPlatform
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('@OCPlatform/Default/index.html.twig');
    }

}
