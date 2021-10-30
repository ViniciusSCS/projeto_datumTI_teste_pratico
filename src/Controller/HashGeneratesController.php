<?php

namespace App\Controller;

use App\Entity\HashGenerates;
use App\Form\HashGeneratesType;
use App\Repository\HashGenaratesRepository;
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
     * @Route("/", name="hash_generates_index", methods={"GET"})
     */
    public function index(HashGenaratesRepository $hashGenaratesRepository): Response
    {
        return $this->render('hash_generates/index.html.twig', [
            'hash_generates' => $hashGenaratesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="hash_generates_new", methods={"GET","POST"})
     */
    public function hashGanerate(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $hg = new HashGenerates();

        $hash = $this->random_string();
        $hg->setStringEntrada($data['string_entrada']);
        $hg->setChaveEncontrada($hash);
        $hg->setHashGerado(md5($data['string_entrada'] . $hash));
        $hg->setTentativas(20);

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($hg);

        $entityManager->flush();

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

    public function encontra_zeros($hg, $count)
    {
        return new JsonResponse($hg);
        $hg = $this->random_string();
        $hash = $data['string_entrada'] . $this->random_string();
        $hg->hash_gerado = md5($hash);

        $confere_zeros = Str::startsWith($hg->hash_gerado, '0000');
        $var = new UnicodeString();

        if ($confere_zeros) {
            $hg->tentativas = $count;
            $hg->save();
            return ['status' => true, 'hashGenerate' => $hg];
        } else {
            $count++;
            $this->encontra_zeros($hg, $count);
        }
    }


    /**
     * @Route("/{id}", name="hash_generates_show", methods={"GET"})
     */
    public function show(HashGenerates $hashGenerate): Response
    {
        return $this->render('hash_generates/show.html.twig', [
            'hash_generate' => $hashGenerate,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="hash_generates_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, HashGenerates $hashGenerate): Response
    {
        $form = $this->createForm(HashGeneratesType::class, $hashGenerate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hash_generates_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hash_generates/edit.html.twig', [
            'hash_generate' => $hashGenerate,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="hash_generates_delete", methods={"POST"})
     */
    public function delete(Request $request, HashGenerates $hashGenerate): Response
    {
        if ($this->isCsrfTokenValid('delete' . $hashGenerate->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($hashGenerate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('hash_generates_index', [], Response::HTTP_SEE_OTHER);
    }
}
