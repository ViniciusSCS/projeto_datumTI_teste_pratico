<?php

namespace App\Controller;

use App\Entity\HashGenerates;
use App\Form\HashGeneratesType;
use App\Repository\HashGenaratesRepository;
use PHPUnit\Framework\Constraint\StringStartsWith;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\MakerBundle\Str;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\UnicodeString;

/**
 * @Route("/hash/generates")
 */
class HashGeneratesController extends AbstractController
{

    /**
     * @Route("/new", name="hash_generates_new", methods={"GET","POST"})
     */
    public function hashGanerate(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $hg = new HashGenerates();
        $string_entrada = $hg->setStringEntrada($data['string_entrada']);

        $this->encontra_zeros($hg, $string_entrada, 1);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($hg);

        return new JsonResponse($hg);
    }

    public function random_string($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function encontra_zeros(HashGenerates $hg, $string_entrada, $count): Response
    {
        $chave_encontrada = $hg->setChaveEncontrada($this->random_string());
        $hash = $hg->getStringEntrada($string_entrada) . $hg->getChaveEncontrada($chave_encontrada);
        $hash_gerado = $hg->setHashGerado(md5($hash));

        $text = new UnicodeString($hg->getHashGerado($hash_gerado));
        $confere_zeros = $text->ignoreCase()->startsWith('0000');

        if ($confere_zeros) {
            $hg->setTentativas($count);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hg);
            $entityManager->flush();
        } else {
            $count++;
            $this->encontra_zeros($hg, $string_entrada, $count);
        }
        return new JsonResponse($hg);
    }
}
