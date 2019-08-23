<?php
/**
 * Created by PhpStorm.
 * User: mha
 * Date: 16/04/19
 * Time: 22:26
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TransactionController
 * @package App\Controller
 */
class TransactionController extends AbstractController
{

    public function entre(Request $request): Response
    {
        return $this->render("Transaction/entre.html.twig");
    }
}