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


    #[Route('/sessionDetail/{id}', name: 'app_sessionDetail')]
    public function sessionDetail(EntityManagerInterface $entityManager, int $id): Response {
        
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $sessionRepo = $entityManager->getRepository(Session::class);

        $session = $sessionRepo->find($id);

        return $this->render('session/sessionDetail.html.twig', [
            'session' => $session,
        ]);

    }


    // Gère l'affichage du form d'ajout/modification MAIS GERE AUSSI l'envoi du form (if isSubmitted  ou juste affichage form )
    #[Route('/session/{id}/edit', name: 'app_editSession')]
    #[Route('/session/{idTraining}/add', name: 'app_addSession')]
    public function add(EntityManagerInterface $entityManager, int $idTraining = null, Session $session = null, Request $request): Response  {

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

        // Si le paramètre idTraining est null, c'est qu'on est dans l'edit d'une session (donc la var existe deja dans Session)
        if (is_null($idTraining)) {
            $idTraining = $session->getTraining()->getId();
        }

        // View qui affiche le formuaire d'ajout
        return $this->render('session/add.html.twig', [
            'formAddSession' => $form->createView(),
            // 'trainingId' => $session->getTraining()->getId(),
            // 'trainingTitle' => $session->getTraining()->getTitle(),
            // Si y'a Id c'est qu'on modifie (sinon renvoie false, = création), pour le titre de la page
            'edit' => $session->getId(),
            'trainingId' => $idTraining
        ]);
    }


    #[Route('/session/{id}/delete', name: 'app_deleteSession')]
    public function deleteSession(EntityManagerInterface $entityManager, int $id, Request $request): Response  {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // Pour redirection: faire passé l'idTraining dans l'url (+ ajouter dans param)

        $sessionRepo = $entityManager->getRepository(Session::class);

        $sessionToDelete = $sessionRepo->find($id);
        $sessionRepo->remove($sessionToDelete, true);

        return $this->redirectToRoute('app_home');

    }



}
