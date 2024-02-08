<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

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

    public function factorielle($x): int
    {
        if ($x == 0) { return 1; }
        else { return $this->factorielle($x-1)*$x; }
    }

    //la variable x, digit + valeur par défaut 1
    #[Route('/combi/{n<\d+>?1}/{p<\d+>?1}')]
    public function combi($n,$p): Response
    {
        return new Response($this->combinaison($n,$p));
    }

    private function combinaison($n,$p):int
    {
        return $this->factorielle($n)/($this->factorielle($p)*$this->factorielle($n-$p));
    }

    #[Route('/beep')]
    public function recuperation($x=null,$y=null): Response
    {
        $request = Request::createFromGlobals();

        $nf = $request->query->get('nf');
        $n = $request->query->get('n');
        $p = $request->query->get('p');

        $s="";
        
        if (is_null($nf) and is_null($n) and is_null($p)) {

        } else if (!is_null($nf) and (strcmp($nf,"")!=0)){
            print("dans le if");
            var_dump(intval($nf));
            $rr=$this->factorielle(intval($nf));
            $s="Factorielle(".$nf.")=".$rr;
        } else if (!is_null($n) and !is_null($p)) {
            $rr=$this->combinaison(intval($n),intval($p));
            $s="Combinaison(".$n.",".$p.")=".$rr;
            //$s="test";//$s."Combinaison(".$n.",".$p.")=".strval($rr);
        }


        return $this->render('monTwig.html.twig', ['string'=>$s, 'cmp'=> strcmp($s,"")]);
    }
}
