<?php
/**
 * Created by PhpStorm.
 * User: leazygomalas
 * Date: 22/10/2018
 * Time: 19:00
 */

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AdvertController extends Controller
{
    public function indexAction()
    {
        $content = $this->get('templating')->render('@OCPlatform/Advert/index.html.twig', array('nom' => 'Philippe'));

        return new Response($content);
    }
}