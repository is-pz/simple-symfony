<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\HttpFoundation\Request;

use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;

class PageController extends AbstractController
{
    #[Route("/")]
    public function home(EntityManagerInterface $entityManager) : Response
    {
        $comments = $entityManager->getRepository(Comment::class)->findAll([], [
            'id' => 'DESC'
        ]);
        return $this->render('home.html.twig',[
            // 'comments' => $entityManager->getRepository(Comment::class)->findAll()
            'comments' => $comments
        ]);
    }
}