<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class FactController extends AbstractController
{
    #[Route('/fact', name: 'app_fact')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/FactController.php',
        ]);
    }

    //la variable x, digit + valeur par défaut 1
    #[Route('/fact/{x<\d+>?1}')]
    public function fact($x): Response
    {
        return new Response($this->factorielle($x));
    }

    public function factorielle($x): Float
    {
        if ($x == 0) { return 1; }
        else { return $this->factorielle($x-1)*$x; }
    }

    //la variable x, digit + valeur par défaut 1
    #[Route('/combi/{n<\d+>?1}/{p<\d+>?1}')]
    public function combi($n,$p): Response
    {
        return new Response($this->factorielle($n)/($this->factorielle($p)*$this->factorielle($n-$p)));
    }

    //la variable x, digit + valeur par défaut 1
    #[Route('/test')]
    public function test(): Response
    {
        return $this->render('monTwig.html.twig');
    }

    #[Route('/beep')]
    public function recuperation(): Response
    {
        return $this->render('monTwig.html.twig');
    }
}
