<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PageController extends AbstractController
{
    #[Route("/")]
    public function home(Request $request) : Response
    {
        $search = $request->get('search');

        return new Response("Welcome to the homepage " . $search);
    }
}