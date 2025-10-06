<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//contrôleur principal qui est un point d’entrée de l’application
class HomeController extends AbstractController
{
    //route racine qui redirige vers l’accueil
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        //rend le template Twig 'home/index.html.twig'
        // le paramètre 'controller_name' peut être utilisé pour afficher le nom du contrôleur
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
