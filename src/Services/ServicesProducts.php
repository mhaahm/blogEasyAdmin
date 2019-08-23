<?php
/**
 * Created by PhpStorm.
 * User: mha
 * Date: 03/04/19
 * Time: 23:15
 */

namespace App\Services;


use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManager;

class ServicesProducts
{
    private $repo;

    public function __construct(ArticleRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAllProducts()
    {
        return $this->repo->findAll();
    }

}