<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Chaine;

class AccueilController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'accueil')]
    public function index(): Response
    {
        $chaines = $this->entityManager->getRepository(Chaine::class)->findAll();

        return $this->render('accueil/index.html.twig', [
            'chaines' => $chaines,
        ]);
    }
}
