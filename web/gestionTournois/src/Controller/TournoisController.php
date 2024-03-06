<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\User;
use App\Entity\Tournois;
use App\Form\SupprTnoisType;
use App\Form\TnoiType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EvType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class TournoisController extends AbstractController
{
    #[Route('/tournois', name: 'app_tournois')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        //populate($entityManager);

        return $this->render('tournois/index.html.twig', [
            'events'=>$entityManager->getRepository(Evenement::class)->findAll(),
        ]);
    }

    #[Route("/tournois/newEvt/{nom<[0-9a-zA-Z ]+>}", name:"newEvt")]
    public function addEvt(String $nom,EntityManagerInterface $entityManager): Response
    {   
        $event=new Evenement();
        $event->setNom($nom);
        $entityManager->persist($event);
        $entityManager->flush();

        return $this->render('tournois/index.html.twig', [
            'events'=>$entityManager->getRepository(Evenement::class)->findAll(),
        ]);
    }

    #[Route("/tournois/newTnoi/{id<[0-9]+>}/{nom<[0-9a-zA-Z ]+>}/{desc?}", name:"newTnoi")]
    public function addTnois($id,String $nom,?string $desc,EntityManagerInterface $entityManager): Response
    {   
        $event=$entityManager->getRepository(Evenement::class)->find($id);
        $tournois=new Tournois();
        $tournois->setNom($nom);
        if(isset($desc)){
            $tournois->setDescription($desc);
        }
        $event->addTournoi($tournois);
        $entityManager->persist($tournois);

        return $this->render('tournois/index.html.twig', [
            'events'=>$entityManager->getRepository(Evenement::class)->findAll(),
        ]);
    }

    #[Route('tournois/eventForm', name: 'app_event_form')]
    public function AddEvtForm(EntityManagerInterface $entityManager, Request $request ):Response
    {
        $event=new Evenement();
        $form = $this->createForm(EvType::class, $event);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $event = $form->getData();
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('app_tournois');
        }

        return $this->render('tournois/ev.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/', name: 'home')]
    public function home(EntityManagerInterface $entityManager, Request $request ):Response
    {   
                return $this->render('tournois/home.html.twig', [
        ]); 
    }

    #[Route('tournois/tnoiForm', name:'ouk_ouk')]
    public function AddTnoiForm(EntityManagerInterface $entityManager, Request $request ):Response
    {   
        $tournois= new Tournois();
        $form =$this->createForm(TnoiType::class, $tournois);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tournois = $form->getData();
            $entityManager->persist($tournois);
            $entityManager->flush();
            return $this->redirectToRoute('app_tournois');
        }
        
        return $this->render('tournois/tnois.html.twig', [
            'form'=>$form
        ]);
    }

    #[Route('tournois/suprTnoiForm', name:'ouk_ouk2')]
    public function SupprTnoiForm(EntityManagerInterface $entityManager, Request $request ):Response
    {   
        $form = $this->createForm(SupprTnoisType::class);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $tournoisSelectionnes = $form->get('tournois')->getData();
            foreach ($tournoisSelectionnes as $tournois) {
                $entityManager->remove($tournois);
            }
            $entityManager->flush();

            $this->addFlash('notice', 'Les tournois sélectionnés ont été supprimés avec succès.');
            return $this->redirectToRoute('home');
        }
        return $this->render('tournois/suptnoi.html.twig', [
            'form'=>$form
        ]);
}
    

    #[Route('tournois/clean', name: 'app_tournois_clean')]
    public function clean(EntityManagerInterface $entityManager): Response
    {
        // Sélectionnez toutes les entités Tournoi
        $tournois = $entityManager->getRepository(Tournois::class)->findAll();

        // Supprimez chaque entité Tournoi
        foreach ($tournois as $tournoi) {
            $entityManager->remove($tournoi);
        }

        $evenement = $entityManager->getRepository(Evenement::class)->findAll();

        // Supprimez chaque entité Tournoi
        foreach ($evenement as $ev) {
            $entityManager->remove($ev);
        }

        // Appliquez les changements à la base de données
        $entityManager->flush();

        // Retournez une réponse ou redirigez l'utilisateur
        // Ici, vous pouvez rediriger l'utilisateur vers une autre page ou simplement afficher un message
        return new Response('Tous les tournois ont été supprimés.');
        // Ou retournez cette ligne pour rediriger vers une route spécifique
        // return $this->redirectToRoute('nom_de_la_route');
    }

    #[Route('user/addAdmin', name: 'app_user_addAdmin')]
    public function addUser(EntityManagerInterface $entityManager,Request $request,UserPasswordHasherInterface $passwordHasher):Response
    {
        $user= new User();
        $user->setEmail("admin@admin.com");
        $plaintextPassword ="password";

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($plaintextPassword);
        $user->setRoles(["ROLE_ADMIN"]);
        $this->addFlash('notice', 'Admin user was added');

        return $this->render('tournois/home.html.twig', [
        ]);
    }

}


function populate($entityManager){
            //Create entities
            $event1=new Evenement();
            $event1->setNom("Rolland Garros");
            $tournois1= new Tournois();
            $tournois1->setNom("simple messieurs");
            $tournois2= new Tournois();
            $tournois2->setNom("double dames");
            $event1->addTournoi($tournois1);
            $event1->addTournoi($tournois2);
    
            $event2=new Evenement();
            $event2->setNom("Trophée beach volley 2024");
            $tournois3 = new Tournois();
            $tournois3->setNom("M15");
            $tournois3->setDescription("réservé aux moins de 15 ans");
            $tournois4= new Tournois();
            $tournois4->setNom("Loisir");
            $event2->addTournoi($tournois3);
            $event2->addTournoi($tournois4);
    
            $entityManager->persist($event1);
            $entityManager->persist($tournois1);
            $entityManager->persist($tournois2);
            $entityManager->persist($event2);
            $entityManager->persist($tournois3);
            $entityManager->persist($tournois4);
            
            $entityManager->flush();
}