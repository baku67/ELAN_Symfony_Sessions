<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Trainer;
use App\Entity\Session;
use App\Form\TrainerType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TrainerController extends AbstractController
{

    #[Route('/trainer', name: 'app_trainer')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        // Méthode rapide pour savoir si User connecté
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        // if($this->getUser()) {}

        $trainerRepo = $entityManager->getRepository(Trainer::class);

        $trainerList = $trainerRepo->findBy([], ['lastName' => 'ASC']);
        $trainerTotalCount = $trainerRepo->count([]);

        return $this->render('trainer/index.html.twig', [
            'trainers' => $trainerList,
            'totalCount' => $trainerTotalCount
        ]);
    }



    // Bouton pour Edit -> route juste en dessous
    #[Route('/trainerDetail/{id}/view', name: 'app_trainerDetail')]
    public function trainerDetail(EntityManagerInterface $entityManager, int $id): Response {

        // Méthode rapide pour savoir si User connecté
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $trainerRepo = $entityManager->getRepository(Trainer::class);
        $sessionRepo = $entityManager->getRepository(Session::class);

        $trainerData = $trainerRepo->find($id);
        $trainerSessions = $sessionRepo->findBy(['trainer' => $id]);
        $trainerSessionsCount = count($trainerSessions);


        return $this->render('trainer/trainerDetail.html.twig', [
            'trainer' => $trainerData,
            'trainerSessions' => $trainerSessions,
            'trainerSessionsCount' => $trainerSessionsCount,
        ]);
    }



    // Gère l'affichage du form d'ajout/modification MAIS GERE AUSSI l'envoi du form (if isSubmitted  ou juste affichage form )
    #[Route('/trainer/{id}/edit', name: 'app_editTrainer')]
    #[Route('/trainer/add', name: 'app_addTrainer')]
    public function add(EntityManagerInterface $entityManager, Trainer $trainer = null, Request $request): Response  {

        // Méthode rapide pour savoir si User connecté
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // On vérifie dans quel cas on est (création ou modification de l'entité)
        if(!$trainer) {
            $flashMsg = "Le formateur a bien été créé";
            $trainer = new Trainer();
        }
        else {
            $flashMsg = "Modifications sauvegardées";
        }

        $form = $this->createForm(TrainerType::class, $trainer);
        $form -> handleRequest($request);

        // Vérifs/Filtres
        if($form->isSubmitted()) {
            if($form->isValid()) {

                // Hydrataion "Entreprise $entreprise" a partir des données du form
                $trainer = $form->getData();
                // Equivalent au prepare et execute PDO (persist() avant si ajout en BDD !)
                $entityManager->persist($trainer);
                $entityManager->flush();

                $this->addFlash('success', $flashMsg);
                return $this->redirectToRoute('app_trainerDetail', array('id' => $trainer->getId()) );
            }
        }


        // View qui affiche le formuaire d'ajout
        return $this->render('trainer/add.html.twig', [
            'formAddTrainer' => $form->createView(),
            // Si y'a Id c'est q'on modifie (sinon renvoie false, = création), pour le titre de la page
            'edit' => $trainer->getId()
        ]);
    }



   
    #[Route('/trainer/{id}/delete', name: 'app_deleteTrainer')]
    public function delete(EntityManagerInterface $entityManager, int $id): Response  {

        // Méthode rapide pour savoir si User connecté
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $trainerRepo = $entityManager->getRepository(Trainer::class);

        $trainerToDelete = $trainerRepo->find($id);

        $trainerRepo->remove($trainerToDelete, true);


        $this->addFlash('success', "Le formateur a bien été supprimé");
        return $this->redirectToRoute('app_trainer');
    }
}
