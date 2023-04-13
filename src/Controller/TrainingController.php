<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Training;
use App\Entity\Session;
use App\Form\TrainingType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TrainingController extends AbstractController
{

    #[Route('/training', name: 'app_training')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        // Méthode rapide pour savoir si User connecté
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        // if($this->getUser()) {}

        $trainingRepo = $entityManager->getRepository(Training::class);

        $trainingList = $trainingRepo->findBy([], ['title' => 'ASC']);
        $trainingTotalCount = $trainingRepo->count([]);

        return $this->render('training/index.html.twig', [
            'trainings' => $trainingList,
            'totalCount' => $trainingTotalCount
        ]);
    }


    // Bouton pour Edit -> route juste en dessous
    #[Route('/trainingDetail/{id}/view', name: 'app_trainingDetail')]
    public function trainingDetail(EntityManagerInterface $entityManager, int $id): Response {

        // Méthode rapide pour savoir si User connecté
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $trainingRepo = $entityManager->getRepository(Training::class);
        $sessionRepo = $entityManager->getRepository(Session::class);

        $trainingData = $trainingRepo->find($id);
        
        $sessions = $sessionRepo->findBy(["training" => $id], ['begin_date' => 'DESC']);

        $incomingSessions = $sessionRepo->findIncomingSessionByTraining($id);
        $ongoingSessions = $sessionRepo->findOngoingSessionByTraining($id);
        $passedSessions = $sessionRepo->findPassedSessionByTraining($id);

        return $this->render('training/trainingDetail.html.twig', [
            'training' => $trainingData,
            'sessions' => $sessions,
            'incomingSessions' => $incomingSessions,
            'ongoingSessions' => $ongoingSessions,
            'passedSessions' => $passedSessions
        ]);
    }



        // Gère l'affichage du form d'ajout/modification MAIS GERE AUSSI l'envoi du form (if isSubmitted  ou juste affichage form )
        #[Route('/training/{id}/edit', name: 'app_editTraining')]
        #[Route('/training/add', name: 'app_addTraining')]
        public function add(EntityManagerInterface $entityManager, Training $training = null, Request $request): Response  {
    
            // Méthode rapide pour savoir si User connecté
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    
            // On vérifie dans quel cas on est (création ou modification de l'entité)
            if(!$training) {
                $training = new Training();
            }
    
            $form = $this->createForm(TrainingType::class, $training);
            $form -> handleRequest($request);
    
            // Vérifs/Filtres
            if($form->isSubmitted()) {
                if($form->isValid()) {
    
                    // Hydrataion "Entreprise $entreprise" a partir des données du form
                    $training = $form->getData();
                    // Equivalent au prepare et execute PDO (persist() avant si ajout en BDD !)
                    $entityManager->persist($training);
                    $entityManager->flush();
    
                    return $this->redirectToRoute('app_trainingDetail', array('id' => $training->getId()) );
                }
            }
    
    
            // View qui affiche le formuaire d'ajout
            return $this->render('training/add.html.twig', [
                'formAddTraining' => $form->createView(),
                // Si y'a Id c'est q'on modifie (sinon renvoie false, = création), pour le titre de la page
                'edit' => $training->getId()
            ]);
        }
    
}
