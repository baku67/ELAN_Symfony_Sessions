<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Trainee;
use App\Entity\Session;
use App\Form\TraineeType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TraineeController extends AbstractController
{


    #[Route('/trainee', name: 'app_trainee')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        // Méthode rapide pour savoir si User connecté
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        // if($this->getUser()) {}

        $traineeRepo = $entityManager->getRepository(Trainee::class);

        $traineeList = $traineeRepo->findBy([], ['lastName' => 'ASC']);
        $traineeTotalCount = $traineeRepo->count([]);

        return $this->render('trainee/index.html.twig', [
            'trainees' => $traineeList,
            'totalCount' => $traineeTotalCount
        ]);
    }


    // Bouton pour Edit -> route juste en dessous
    #[Route('/traineeDetail/{id}/view', name: 'app_traineeDetail')]
    public function traineeDetail(EntityManagerInterface $entityManager, int $id): Response {

        // Méthode rapide pour savoir si User connecté
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $traineeRepo = $entityManager->getRepository(Trainee::class);
        $trainee = $traineeRepo->find($id);

        if (is_null($trainee)) {
            $this->addFlash('error', 'Le stagiaire demandé n\'existe pas');
            return $this->redirectToRoute('app_trainee');
        }

        $traineeSessions = $trainee->getSessions();

        $sessionRepo = $entityManager->getRepository(Session::class);

        $incomingSessionsTrainee = $sessionRepo->findIncomingSessionsByTrainee($id);
        $inProgressSessionsTrainee =  $sessionRepo->findInProgressSessionsByTrainee($id);
        $passedSessionsTrainee =  $sessionRepo->findPassedSessionsByTrainee($id);

        $nbrIncomingSessions = count($incomingSessionsTrainee);
        $nbrInProgressSessions = count($inProgressSessionsTrainee);
        $nbrPassedSessions = count($passedSessionsTrainee);
        

        return $this->render('trainee/traineeDetail.html.twig', [
            'trainee' => $trainee,
            'traineeSessions' => $traineeSessions,
            'incomingSessionsTrainee' => $incomingSessionsTrainee,
            'inProgressSessionsTrainee' => $inProgressSessionsTrainee,
            'passedSessionsTrainee' => $passedSessionsTrainee,
            'nbrIncomingSessions' => $nbrIncomingSessions,
            'nbrInProgressSessions' => $nbrInProgressSessions,
            'nbrPassedSessions' => $nbrPassedSessions
        ]);
    }



    // Gère l'affichage du form d'ajout/modification MAIS GERE AUSSI l'envoi du form (if isSubmitted  ou juste affichage form )
    #[Route('/trainee/{id}/edit', name: 'app_editTrainee')]
    #[Route('/trainee/add', name: 'app_addTrainee')]
    public function add(EntityManagerInterface $entityManager, Trainee $trainee = null, Request $request): Response  {

        // Méthode rapide pour savoir si User connecté
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // On vérifie dans quel cas on est (création ou modification de l'entité)
        if(!$trainee) {
            $trainee = new Trainee();
            $flashMsg = "Le stagiaire a bien été ajouté";
        }
        else {
            $flashMsg = "Modifications sauvegardées";
        }

        $form = $this->createForm(TraineeType::class, $trainee);
        $form -> handleRequest($request);

        // Vérifs/Filtres
        if($form->isSubmitted()) {
            if($form->isValid()) {

                // Hydrataion "Entreprise $entreprise" a partir des données du form
                $trainee = $form->getData();
                // Equivalent au prepare et execute PDO (persist() avant si ajout en BDD !)
                $entityManager->persist($trainee);
                $entityManager->flush();

                $this->addFlash('success', $flashMsg);
                return $this->redirectToRoute('app_traineeDetail', array('id' => $trainee->getId()) );
            }
        }


        // View qui affiche le formuaire d'ajout
        return $this->render('trainee/add.html.twig', [
            'formAddTrainee' => $form->createView(),
            // Si y'a Id c'est q'on modifie (sinon renvoie false, = création), pour le titre de la page
            'edit' => $trainee->getId()
        ]);
    }


    #[Route('/trainee/{id}/delete', name: 'app_deleteTrainee')]
    public function delete(EntityManagerInterface $entityManager, int $id): Response  {

        // Méthode rapide pour savoir si User connecté
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $traineeRepo = $entityManager->getRepository(Trainee::class);

        $traineeToDelete = $traineeRepo->find($id);

        $traineeRepo->remove($traineeToDelete, true);
        

        $this->addFlash('success', "Le stagiaire a bien été supprimé");
        return $this->redirectToRoute('app_trainee');
    }
}
