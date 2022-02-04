<?php

namespace App\Controller;

use App\Entity\CommandeDetail;
use App\Form\CommandeDetailType;
use App\Repository\CommandeDetailRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/commande/detail')]
class AdminCommandeDetailController extends AbstractController
{
    #[Route('/', name: 'admin_commande_detail_index', methods: ['GET'])]
    public function index(CommandeDetailRepository $commandeDetailRepository): Response
    {
        return $this->render('admin_commande_detail/index.html.twig', [
            'commande_details' => $commandeDetailRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_commande_detail_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $commandeDetail = new CommandeDetail();
        $form = $this->createForm(CommandeDetailType::class, $commandeDetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($commandeDetail);
            $entityManager->flush();

            return $this->redirectToRoute('admin_commande_detail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_commande_detail/new.html.twig', [
            'commande_detail' => $commandeDetail,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_commande_detail_show', methods: ['GET'])]
    public function show(CommandeDetail $commandeDetail): Response
    {
        return $this->render('admin_commande_detail/show.html.twig', [
            'commande_detail' => $commandeDetail,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_commande_detail_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CommandeDetail $commandeDetail, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommandeDetailType::class, $commandeDetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_commande_detail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_commande_detail/edit.html.twig', [
            'commande_detail' => $commandeDetail,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_commande_detail_delete', methods: ['POST'])]
    public function delete(Request $request, CommandeDetail $commandeDetail, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandeDetail->getId(), $request->request->get('_token'))) {
            $entityManager->remove($commandeDetail);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_commande_detail_index', [], Response::HTTP_SEE_OTHER);
    }
}
