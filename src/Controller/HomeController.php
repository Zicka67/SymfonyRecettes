<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    //
    //#[Route('home', methods: ['GET'])] si on veut y acceder avec : http://127.0.0.1:8000/home
    #[Route('/', 'home.html', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('pages/home.html.twig');
    }
}