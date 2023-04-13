<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Trainee;
use App\Entity\Session;
use App\Entity\TraineeSession;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TraineeSessionController extends AbstractController
{
    #[Route('/trainee/session', name: 'app_trainee_session')]
    public function index(): Response
    {
        return $this->render('trainee_session/index.html.twig', [
        ]);
    }


    #[Route('/traineeSession/remove/{id}/{idSession}', name: 'app_removetraineeSession')]
    public function remove(EntityManagerInterface $entityManager, int $id, int $idSession): Response
    {

        // Méthode rapide pour savoir si User connecté
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $traineeSessionRepo = $entityManager->getRepository(TraineeSession::class);
        $traineeRepo = $entityManager->getRepository(Trainee::class);
        $sessionRepo = $entityManager->getRepository(Session::class);



        $trainee = $traineeRepo->find($id);
        $session = $sessionRepo->find($idSession);

        $traineeSessionToRemove = $traineeSessionRepo->findOneBy(['trainee' => $trainee->getId(), 'session' => $session->getId()]);

        $traineeSessionRepo->remove($traineeSessionToRemove, true);

        return $this->redirectToRoute('app_sessionDetail', array('id' => $idSession) );

    }

}
