<?php
// src/Form/ChaineType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Chaine;

class ChaineType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder
// Customize your form fields here
->add('libelle')
->add('diffuseur');
}

public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults([
'data_class' => Chaine::class,
]);
}
}
?>