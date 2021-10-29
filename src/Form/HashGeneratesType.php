<?php

namespace App\Form;

use App\Entity\HashGenerates;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HashGeneratesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('string_entrada')
            ->add('chave_encontrada')
            ->add('hash_gerado')
            ->add('tentativas')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HashGenerates::class,
        ]);
    }
}
