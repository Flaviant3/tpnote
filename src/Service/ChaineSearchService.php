<?php

namespace App\Service;

use App\Entity\Chaine;
use App\Repository\ChaineRepository;

class ChaineSearchService
{
    private $chaineRepository;

    public function __construct(ChaineRepository $chaineRepository)
    {
        $this->chaineRepository = $chaineRepository;
    }

    public function searchByPartialLibelle($query)
    {
        return $this->chaineRepository->findByPartialLibelle($query);
    }
}
