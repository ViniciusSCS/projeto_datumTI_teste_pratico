<?php

namespace App\Controller;

use App\Service\HashGenerateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


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
        $qtd_request = $qtd_request - 1;
        for($i = 1; $i <= $qtd_request; $i++) {
            $this->service->hashGanerate($hashGerado);
        }
    }
}
