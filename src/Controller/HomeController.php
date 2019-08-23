<?php
/**
 * Created by PhpStorm.
 * User: mha
 * Date: 02/04/19
 * Time: 14:05
 */

namespace App\Controller;


use App\Services\ServicesProducts;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends  AbstractController
{
    private $service_product;
    public function __construct(ServicesProducts $serve)
    {
        $this->service_product = $serve;
    }

    public function home(Request $request)
    {
        // extract all product
        $articles = $this->service_product->getAllProducts();
        return $this->render("home/home.html.twig",[
              'articles' =>$articles
            ]
        );
    }
}