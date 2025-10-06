<?php

namespace App\Controller;

use App\Entity\Passage;
use App\Form\PassageType;
use App\Repository\PassageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/passage')]
final class PassageController extends AbstractController
{
    #[Route(name: 'app_passage_index', methods: ['GET'])]
    public function index(PassageRepository $passageRepository): Response
    {
        return $this->render('passage/index.html.twig', [
            'passages' => $passageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_passage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $passage = new Passage();
        $form = $this->createForm(PassageType::class, $passage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($passage);
            $entityManager->flush();

            return $this->redirectToRoute('app_passage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('passage/new.html.twig', [
            'passage' => $passage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_passage_show', methods: ['GET'])]
    public function show(Passage $passage): Response
    {
        return $this->render('passage/show.html.twig', [
            'passage' => $passage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_passage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Passage $passage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PassageType::class, $passage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_passage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('passage/edit.html.twig', [
            'passage' => $passage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_passage_delete', methods: ['POST'])]
    public function delete(Request $request, Passage $passage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$passage->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($passage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_passage_index', [], Response::HTTP_SEE_OTHER);
    }
}
