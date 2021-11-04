<?php


namespace App\Controller;


use App\Entity\HashGenerates;


class HashCommandController
{

    public function getHashCommand($hashGenerate, $qtd_request)
    {

        for ($i = 1; $i <= $qtd_request; $i++)
        {
            return $hashGenerate;
        }

    }
}