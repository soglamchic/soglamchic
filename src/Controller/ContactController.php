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


        $form= $this->createForm(ContactType::class);

        $form->handleRequest($request);

        $data=$form->getData();


        if($form->isSubmitted() && $form->isValid()){
            
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
