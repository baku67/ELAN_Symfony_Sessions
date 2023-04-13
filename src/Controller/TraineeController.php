<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Trainee;
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

        $traineeData = $traineeRepo->find($id);

        return $this->render('trainee/traineeDetail.html.twig', [
            'trainee' => $traineeData,
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
}
