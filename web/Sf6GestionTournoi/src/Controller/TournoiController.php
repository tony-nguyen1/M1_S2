<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

class TournoiController extends AbstractController
{
    #[Route('/tournoi', name: 'app_tournoi')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $evts = $entityManager->getRepository("App\Entity\Evenement")->findAll();

        return $this->render('tournoi/tournois.html.twig', [
            'evts' => $evts,
        ]);
    }

    #[Route("/tournoi/newEvt/{nom<[0-9a-zA-Z ]+>}", name:"newEvt")]
    public function add(EntityManagerInterface $entityManager, $nom): Response
    {
        $evts = $entityManager->getRepository("App\Entity\Evenement")->findAll();

        print($nom);

        return $this->render('tournoi/tournois.html.twig', [
            'evts' => $evts,
        ]);
    }
}
