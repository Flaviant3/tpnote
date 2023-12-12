<?php
// src/Controller/VideoController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;


class VideoController extends AbstractController
{
private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/videos', name: 'video_list')]
    public function listVideos(): Response
    {
        $videos = $this->entityManager->getRepository(Video::class)->findBy([], ['titre' => 'ASC']);

        return $this->render('video/list.html.twig', [
            'videos' => $videos,
        ]);
    }

#[Route('/video/{id}', name: 'video_show')]
public function show(Video $video): Response
{
return $this->render('video/show.html.twig', [
'video' => $video,
]);
}
}
?>