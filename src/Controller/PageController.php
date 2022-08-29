<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Comment;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;

class PageController extends AbstractController
{
    #[Route("/", name: 'home')]
    public function home(EntityManagerInterface $entityManager, Request $request) : Response
    {
        $form = $this->createForm(CommentType::class);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $entityManager->persist($form->getData());
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        $comments = $entityManager->getRepository(Comment::class)->findAll([], [
            'id' => 'DESC'
        ]);
        return $this->render('home.html.twig',[
            'comments' => $comments,
            'form' => $form->createView()
        ]);
    }
}