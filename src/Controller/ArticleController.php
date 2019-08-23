<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


class ArticleController extends AbstractController
{


    public function showArticle(Request $request, Article $article)
    {

        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    public function newArticle(Request $request)
    {
        $Article = new Article();
        $formArtcile = $this->createForm(ArticleType::class,$Article);
        $formArtcile->handleRequest($request);
        if($formArtcile->isSubmitted() and $formArtcile->isValid())
        {
            $Article = $formArtcile->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Article);
            $entityManager->flush();
            return $this->redirectToRoute('index');
        }
        return $this->render('article/newArticle.html.twig',[
            'form'=>$formArtcile->createView()
        ]);
    }

    public function editArticle(Request $request,Article $article)
    {
        $articleForm = $this->createForm(ArticleType::class,$article);
        $articleForm->handleRequest($request);
        if($articleForm->isSubmitted() and $articleForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();
            return $this->redirectToRoute('index');
        }
        return $this->render('article/editArticle.html.twig',[
            'form'=>$articleForm->createView()
        ]);
    }
}
