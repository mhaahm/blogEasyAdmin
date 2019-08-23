<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\CategorieArticle;
use App\Entity\Fournisseur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class AppFixtures extends Fixture
{
    private $data = [];
    public function __construct()
    {
        $this->getDataFromFile();
    }

    public function load(ObjectManager $manager)
    {
        $data = $this->getDataFromFile();
        array_shift($data['categories']);
        $categories = [];
        foreach ($data['categories'] as $line)
        {
            $categData  =  str_getcsv($line,',','"');
            $categ = new CategorieArticle();
            $categ->setName($categData[1]);
            $manager->persist($categ);
            $categories[$categData[0]] = $categ;
        }
        array_shift($data['fournisseur']);
        $fournisseurs = [];
        foreach ($data['fournisseur'] as $line)
        {
            $fourn  =  str_getcsv($line,',','"');
            $fournisseur = new Fournisseur();
            $fournisseur->setName($fourn[1]);
            $fournisseur->setAdresse($fourn[2].' '.$fourn[3]);
            $fournisseur->setPays($fourn[4]);
            $fournisseur->setTelephone($fourn[5]);
            $manager->persist($fournisseur);
            $fournisseurs[$fourn[0]] = $fournisseur;
        }
        //Réf produit,Produit,description,unité mesure,prix vente,fournisseur,catégories
        array_shift($data['article']);
        foreach ($data['article'] as $line)
        {
            $arti = str_getcsv($line,',','"');
            $article = new Article();
            if(isset($categories[$arti[6]])) {
                $article->setCategorie($categories[$arti[6]]);
            } else {
                $article->setCategorie($categories[1]);
            }
            if(isset($fournisseurs[$arti[5]])) {
                $article->setFournisseur($fournisseurs[$arti[5]]);
            } else {
                $article->setFournisseur($fournisseurs[1]);
            }
            $article->setLibele($arti[1]);
            $article->setDescription($arti[2]);
            $article->setQuantite(5000);
            $article->setUniteMasure($arti[3]);
            $article->setPrix($arti[4]);
            $manager->persist($article);
        }
        $manager->flush();
    }

    private function getDataFromFile()
    {
        //Réf produit,Produit,description,unité mesure,prix vente,fournisseur,catégories
        $articles = file(__DIR__."/../../Data/Produit.csv");
        //réf catégorie,catégorie
        $categories = file(__DIR__."/../../Data/Catégorie.csv");
        //N°fornisseur,Nom,adresse,Code postal,ville,N°tél,N°fax
        $fournisseurs = file(__DIR__."/../../Data/Fournisseur.csv");
        //n° vente,date,quantité,produit
        $vente = file(__DIR__."/../../Data/Vente.csv");
        return [
          'article' => $articles,
          'categories' => $categories,
          'fournisseur' =>$fournisseurs,
          'vente'=> $vente
        ];
    }
}
