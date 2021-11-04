<?php


namespace App\Service;

use App\Entity\HashGenerates;
use App\Repository\HashGeneratesRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\String\UnicodeString;

class HashGenerateService
{
    private $hashGenerate;
    private $returnTestes = false;
    private $hashAux = null;
    private $countAux = 0;

    public function __construct(HashGeneratesRepository $hashGenerate)
    {
        $this->hashGenerate = $hashGenerate;
    }

    public function hashGanerate(string $string_entrada)
    {
        $dataResult = $this->encontra_zeros($string_entrada, 1);

        if ($dataResult) {
            return $this->hashAux;
        } else {
            $this->encontra_zeros($string_entrada, $this->countAux);
        }
    }

    private function random_string($length = 8): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function encontra_zeros($string_entrada, $count): bool
    {
        $hash =  $this->random_string();
        $hashConcat =$string_entrada . $this->random_string();

        $hash_gerado = md5($hashConcat);

        $text = new UnicodeString($hash_gerado);
        $confere_zeros = $text->ignoreCase()->startsWith('0000');

        if ($confere_zeros) {
             $this->hashGenerate->store($string_entrada, $hash_gerado, $hash, $count);
             $this->hashAux = $hash_gerado;
             $this->countAux = $count;
             return $this->returnTestes = true;
        }
        $count++;
        $this->encontra_zeros($string_entrada, $count);

        return $this->returnTestes;

    }
}