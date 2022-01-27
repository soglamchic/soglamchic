<?php

// une classe AcceuilController dans le
//répertoire src/Controller/. La classe 
//générée contient du code standard.

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilController extends AbstractController
{
    //[Route('/acceul', name: 'acceuil')]
    // est ce qui fait de la méthode index()
    //dans public un contrôleur.

    #[Route('/acceuil', name: 'acceuil')]
    public function index(): Response
    {
        // affiche templates
        //('acceuil/index.html.twig
        
        return $this->render('acceuil/index.html.twig', [
            'controller_name' => 'AcceuilController',
        ]);
    }
}
