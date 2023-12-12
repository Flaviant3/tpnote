<?php
// src/Controller/ChaineController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Chaine;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ChaineType;

class ChaineController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/chaine', name: 'chaine')]
    public function index(): Response
    {
        $chaines = $this->entityManager->getRepository(Chaine::class)->findAll();

        return $this->render('chaine/index.html.twig', [
            'chaines' => $chaines,
        ]);
    }

    #[Route('/chaine/ajouter', name: 'chaine_add')]
    public function addChaine(Request $request): Response
    {
        $chaine = new Chaine();
        $form = $this->createForm(ChaineType::class, $chaine);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($chaine);
            $this->entityManager->flush();

            return $this->redirectToRoute('chaine');
        }

        return $this->render('chaine/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/chaine/{id}', name: 'chaine_show')]
    public function show(Chaine $chaine): Response
    {
        return $this->render('chaine/show.html.twig', [
            'chaine' => $chaine,
        ]);
    }

    #[Route('/chaine/editer/{id}', name: 'chaine_edit')]
    public function editChaine(Request $request, Chaine $chaine): Response
    {
        $form = $this->createForm(ChaineType::class, $chaine);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('chaine_show', ['id' => $chaine->getId()]);
        }

        return $this->render('chaine/edit.html.twig', [
            'form' => $form->createView(),
            'chaine' => $chaine,
        ]);
    }

    #[Route('/recherche', name: 'recherche')]
    public function recherche(Request $request, ChaineSearchService $chaineSearchService): Response
    {
        $query = $request->query->get('q'); // Get the search query from the request

        // Perform a simple search based on the query using the service
        $chaines = $chaineSearchService->searchByPartialLibelle($query);

        return $this->render('recherche/index.html.twig', [
            'chaines' => $chaines,
        ]);
    }
}
?>