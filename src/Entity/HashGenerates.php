<?php

namespace App\Entity;

use App\Repository\HashGenaratesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HashGenaratesRepository::class)
 */
class HashGenerates
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $string_entrada;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $chave_encontrada;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hash_gerado;

    /**
     * @ORM\Column(type="bigint")
     */
    private $tentativas;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStringEntrada(): ?string
    {
        return $this->string_entrada;
    }

    public function setStringEntrada(string $string_entrada): self
    {
        $this->string_entrada = $string_entrada;

        return $this;
    }

    public function getChaveEncontrada(): ?string
    {
        return $this->chave_encontrada;
    }

    public function setChaveEncontrada(string $chave_encontrada): self
    {
        $this->chave_encontrada = $chave_encontrada;

        return $this;
    }

    public function getHashGerado(): ?string
    {
        return $this->hash_gerado;
    }

    public function setHashGerado(string $hash_gerado): self
    {
        $this->hash_gerado = $hash_gerado;

        return $this;
    }

    public function getTentativas(): ?string
    {
        return $this->tentativas;
    }

    public function setTentativas(string $tentativas): self
    {
        $this->tentativas = $tentativas;

        return $this;
    }
}
