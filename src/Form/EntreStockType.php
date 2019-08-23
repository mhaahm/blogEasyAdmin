<?php
/**
 * Created by PhpStorm.
 * User: mha
 * Date: 16/04/19
 * Time: 22:43
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EntreStockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('quantite')
            ->add('prixEntre')
            ->add('dateEntre')
            ->add("employe");
    }
}