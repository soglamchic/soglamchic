<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/serie')]
class AdminSerieController extends AbstractController
{
    #[Route('/', name: 'admin_serie_index', methods: ['GET'])]
    public function index(SerieRepository $serieRepository): Response
    {
        return $this->render('admin_serie/index.html.twig', [
            'series' => $serieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_serie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $serie = new Serie();
        $form = $this->createForm(SerieType::class, $serie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($serie);
            $entityManager->flush();

            return $this->redirectToRoute('admin_serie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_serie/new.html.twig', [
            'serie' => $serie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_serie_show', methods: ['GET'])]
    public function show(Serie $serie): Response
    {
        return $this->render('admin_serie/show.html.twig', [
            'serie' => $serie,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_serie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Serie $serie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SerieType::class, $serie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_serie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_serie/edit.html.twig', [
            'serie' => $serie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_serie_delete', methods: ['POST'])]
    public function delete(Request $request, Serie $serie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$serie->getId(), $request->request->get('_token'))) {
            $entityManager->remove($serie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_serie_index', [], Response::HTTP_SEE_OTHER);
    }
}
