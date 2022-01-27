<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request): Response
    {

    //Crée et renvoie un exemple Form
    // à partir du type du formulaire.

        $form= $this->createForm(ContactType::class);

        $form->handleRequest($request);

        $data=$form->getData();

        
        // effectue une action..
        //$form représente les données 
        //utiles envoyées par la fusion des 
        //paramètres est nécessaire pour 
        //soumettre tous les champs du formulaire.

        if($form->isSubmitted() && $form->isValid()){
            
        // data est un tableau avec les clés mail et message.

            $data = $form->getData();

            $mail = $data ['mail'];

            $message = $data['message'];
            

            return $this->render('contact/success.html.twig',[
                'controller_name' => 'ContactController',
                'mail' => $mail,
                'message' => $message
            ]);


                }else{ 
            return $this->renderForm('contact/index.html.twig', [
                'controller_name' => 'ContactController',
                'formulaire' => $form 
             ]);

        }

       


    }
}
