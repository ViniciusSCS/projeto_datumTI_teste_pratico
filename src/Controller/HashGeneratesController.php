<?php

namespace App\Controller;

use App\Entity\HashGenerates;
use App\Service\HashGenerateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\String\UnicodeString;


class HashGeneratesController extends AbstractController
{

    private $service;

    public function __construct(HashGenerateService $service)
    {
        $this->service = $service;
    }

    public function initHash(string $string_entrada, $qtd_request)
    {
        $hashGerado = $this->service->hashGanerate($string_entrada);
        $this->generateBaseHash($hashGerado, $qtd_request);
    }

    private function generateBaseHash(string $hashGerado, $qtd_request)
    {
        for($i = 1; $i<= $qtd_request; $i++) {
            $this->service->hashGanerate($hashGerado);
        }

        return ['Tudo gravado'];
    }
}
