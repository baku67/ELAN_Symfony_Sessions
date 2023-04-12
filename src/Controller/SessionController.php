<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Session;
use App\Form\SessionType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(): Response
    {
        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }


    // Gère l'affichage du form d'ajout/modification MAIS GERE AUSSI l'envoi du form (if isSubmitted  ou juste affichage form )
    #[Route('/session/{id}/edit', name: 'app_editSession')]
    #[Route('/session/add', name: 'app_addSession')]
    public function add(EntityManagerInterface $entityManager, Session $session = null, Request $request): Response  {

        // Méthode rapide pour savoir si User connecté
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // On vérifie dans quel cas on est (création ou modification de l'entité)
        if(!$session) {
            $session = new Session();
        }

        $form = $this->createForm(SessionType::class, $session);
        $form -> handleRequest($request);

        // Vérifs/Filtres
        if($form->isSubmitted()) {
            if($form->isValid()) {

                // Hydrataion "Entreprise $entreprise" a partir des données du form
                $session = $form->getData();
                // Equivalent au prepare et execute PDO (persist() avant si ajout en BDD !)
                $entityManager->persist($session);
                $entityManager->flush();

                // On récupère l'id de la formation "mère" pour rediriger vers Détail formation
                return $this->redirectToRoute('app_trainingDetail', array('id' => $session->getTraining()->getId()) );
            }
        }


        // View qui affiche le formuaire d'ajout
        return $this->render('session/add.html.twig', [
            'formAddSession' => $form->createView(),
            // 'trainingId' => $session->getTraining()->getId(),
            // Si y'a Id c'est qu'on modifie (sinon renvoie false, = création), pour le titre de la page
            'edit' => $session->getId()
        ]);
    }

}
