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
    public function index(): Response
    {
        return $this->render('trainee/index.html.twig', [
            'controller_name' => 'TraineeController',
        ]);
    }



    // Gère l'affichage du form d'ajout/modification MAIS GERE AUSSI l'envoi du form (if isSubmitted  ou juste affichage form )
    #[Route('/trainee/{id}/edit', name: 'app_editTrainee')]
    #[Route('/trainee/add', name: 'app_addTrainee')]
    public function add(EntityManagerInterface $entityManager, Trainee $trainee = null, Request $request): Response  {

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

                return $this->redirectToRoute('app_traineeList');
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
