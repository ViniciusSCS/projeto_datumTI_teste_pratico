<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HashGenerateController extends AbstractController
{
    /**
     * @Route("/hash/genarate", name="hash_genarate")
     */
    public function index(): Response
    {
        return $this->render('hash_genarate/index.html.twig', [
            'controller_name' => 'HashGenerateController',
        ]);
    }

    public function hashGenerate(Request $request): Response
    {
        $data = $request;
        return $this->json($data);


        $var = 'Funciona';
        return $this->json($var);
    }
}
