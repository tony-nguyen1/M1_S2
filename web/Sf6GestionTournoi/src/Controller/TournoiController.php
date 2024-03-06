<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Evenement;
use App\Entity\Tournoi;

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
        $evt=new Evenement(); // constructeur par défaut tjrs

        $evt->setNom($nom);
        $evt->setDateDeb(date_create("01-01-2020"));
        $evt->setDateFin(date_create("01-01-2020"));

        $entityManager->persist($evt);
        $entityManager->flush();

        return new Response("Événement '$nom' créé avec l'id : ".$evt->getId().' !');
    }

    #[Route("/tournoi/newTnoi/{evtid<[0-9]+>}/{nom<[0-9a-zA-Z ]+>}/", name:"newTnoi")]
    public function addAdd(EntityManagerInterface $entityManager, $evtid, $nom): Response
    {
        $tnoi=new Tournoi(); // constructeur par défaut tjrs
        $tnoi->setDescription($nom);
        $evt = $entityManager->find("App\Entity\Evenement",(int)$evtid);

        if($evt === null){
            return new Response("L'événement $evtid n'existe pas ! Le tournoi n'a pas été créé !");
        } else {
            $tnoi->setEvenement($evt);
            $entityManager->persist($tnoi); // en tampon
            $entityManager->flush();
            return new Response("Le tournoi {$tnoi->getDescription()} a été enregistré dans l'événement {$evt->getNom()} !");
        }
    }
}
