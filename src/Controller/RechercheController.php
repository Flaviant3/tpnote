<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends AbstractController
{
    #[Route('/recherche', name: 'recherche')]
    public function recherche(Request $request, ChaineSearchService $chaineSearchService): Response
    {
        $query = $request->query->get('q');

        $chaines = [];

        if ($query) {
            $chaines = $chaineSearchService->searchByPartialLibelle($query);
        }

        return $this->render('recherche/index.html.twig', [
            'chaines' => $chaines,
        ]);
    }
}
