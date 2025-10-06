<?php

namespace App\Controller;

use App\Entity\Arret;
use App\Form\ArretType;
use App\Repository\ArretRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/arret')]
final class ArretController extends AbstractController
{
    #[Route(name: 'app_arret_index', methods: ['GET'])]
    public function index(ArretRepository $arretRepository): Response
    {
        return $this->render('arret/index.html.twig', [
            'arrets' => $arretRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_arret_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $arret = new Arret();
        $form = $this->createForm(ArretType::class, $arret);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($arret);
            $entityManager->flush();

            return $this->redirectToRoute('app_arret_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('arret/new.html.twig', [
            'arret' => $arret,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_arret_show', methods: ['GET'])]
    public function show(Arret $arret): Response
    {
        return $this->render('arret/show.html.twig', [
            'arret' => $arret,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_arret_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Arret $arret, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ArretType::class, $arret);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_arret_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('arret/edit.html.twig', [
            'arret' => $arret,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_arret_delete', methods: ['POST'])]
    public function delete(Request $request, Arret $arret, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$arret->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($arret);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_arret_index', [], Response::HTTP_SEE_OTHER);
    }
}
