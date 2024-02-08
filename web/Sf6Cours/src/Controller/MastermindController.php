<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Mastermind;

class MastermindController extends AbstractController
{
    #[Route('/mastermind', name: 'app_mastermind')]
    // request, injection de dépendance
    // injection de service
    public function index(Request $request): Response
    {

        // !!!
        $session = $request->getSession();

        $session->set('test', "testing");

        $foo = $session->get('test');

        //$request = Request::createFromGlobals();
        $prop = $request->query->get('proposition');

        $jeu = new Mastermind();;
        var_dump($session->get('jeu'));
        // $session->has('key')
        // null !== ...
        if (is_null($session->get('jeu'))) {
            // $jeu = new Mastermind();
        } else {
            $jeu = $session->get('jeu');
        }
        // var_dump($jeu);
        $jeu->test('1212');


        var_dump($jeu);
        $jeu_string = serialize($jeu);

        var_dump($jeu_string);

        $jeu_bis = new Mastermind();
        $jeu_bis->unserialize($jeu_string);
        // $jeu_bis = $jeu_bis->unserialize($jeu_string);
        // $jeu_bis->unserialize('{"propositions":[["1212",2,0]],"t":4,"secret":"1234"}');
        var_dump($jeu_bis);


        // $this->addFlash('notice',$message); //notice,warning,error

        return $this->render('mastermind/index.html.twig', [
            'controller_name' => 'MastermindController',
            'foo' => $foo,
            'prop' => $prop,
        ]);
    }
}
