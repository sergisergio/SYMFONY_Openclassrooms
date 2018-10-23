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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
    public function indexAction($page)
    {
        // On veut avoir l'URL de l'annonce d'id 5.
        //$url = $this->get('router')->generate(
            //'oc_platform_view', // 1er argument : le nom de la route
            //array('id' => 5)    // 2e argument : les valeurs des paramètres
        //);
        // $url vaut « /platform/advert/5 »

        //return new Response("L'URL de l'annonce d'id 5 est : ".$url);

        // On ne sait pas combien de pages il y a
        // Mais on sait qu'une page doit être supérieure ou égale à 1
        if ($page < 1) {
            // On déclenche une exception NotFoundException, cela va afficher
            // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
            throw new NotFoundHttpException('Page"'.$page.'" inexistante.');
        }

        // Ici, on récupère la liste des annonces, puis on la passera au template

        // Mais pour l'instant, on ne fait qu'appeler le template
        return $this->render('OCPlatform/Advert/index.html.twig');
    }
    // La route fait appel à OCPlatformBundle:Advert:view,
    // on doit donc définir la méthode viewAction.
    // On donne à cette méthode l'argument $id, pour
    // correspondre au paramètre {id} de la route
    public function viewAction($id/*, Request $request*/)
    {
        // $id vaut 5 si l'on a appelé l'URL /platform/advert/5

        // Ici, on récupèrera depuis la base de données
        // l'annonce correspondant à l'id $id.
        // Puis on passera l'annonce à la vue pour
        // qu'elle puisse l'afficher
        //$tag = $request->query->get('tag');

        return $this->render('@OCPlatform/Advert/view.html.twig',
            array('id'  => $id/*, 'tag' => $tag*/));

        // Sinon pour rediriger, on fait comme çà
        // return $this->RedirectToRoute('oc_platform_home');
    }

    // On récupère tous les paramètres en arguments de la méthode
    public function viewSlugAction($slug, $year, $format)
    {
        return new Response(
            "On pourrait afficher l'annonce correspondant au
            slug '".$slug."', créée en ".$year." et au format ".$format."."
        );
    }

    /*public function indexAction()
    {
        $content = $this->get('templating')->render('@OCPlatform/Advert/index.html.twig', array('nom' => 'Philippe'));

        return new Response($content);
    }*/

    public function addAction(Request $request)
    {
        //$session = $request->getSession();

        //$session->getFlashBag()->add('info', 'Annonce bien enregistrée');

        // Le " flashbag " est ce qui contient les messages flash dans la session
        // Il peut bien sûr contenir plusieurs messages
        //$session->getFlashBag()->add('info', 'Oui oui, elle est bien enregistrée !');

        // Puis on redirige vers la page de visualisation de cette annonce
        //return $this->redirectToRoute('oc_platform_view', array('id' => 5));

        // La gestion d'un formulaire est particulière, mais l'idée est la suivante :

        // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
        if ($request->isMethod('POST')) {
            // Ici, on s'occupera de la création et de la gestion du formulaire

            $request->gestSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            // Puis on redirige vers la page de visualisation de cette annonce
            return $this->redirectToRoute('oc_platform_view', array('id' => 5));

            // Si on n'est pas en POST, alors on affiche le formulaire
            return $this->render('@OCPlatform/Advert/add.html.twig');
        }
    }

    public function editAction($id, Request $request)
    {
        // Ici, on récupérera l'annonce correspondante à $id

        // Même mécanisme que pour l'ajout
        if ($request->isMethod('POST')) {
            $request->gestSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

            return $this->redirectToRoute('oc_platform_view', array('id' => 5));
        }

        return $this->render('@OCPlatform/Advert/edit.html.twig');
    }

    public function deleteAction($id)
    {
        // Ici, on récupérera l'annonce correspondant à $id

        // Ici, on gérera la su^suppression de l'annonce en question

        return $this->render('@OCPlatform/Advert/delete.html.twig');
    }

    public function byebyeAction()
    {
        $content = $this->get('templating')->render('@OCPlatform/Advert/byebye.html.twig', array('nom' => 'Philippe'));

        return new Response($content);
    }
}