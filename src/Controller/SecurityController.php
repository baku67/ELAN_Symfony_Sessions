<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Trainee;
use App\Entity\Trainer;
use App\Entity\Training;
use App\Entity\Session;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    #[Route(path: '', name: 'app_landingPage')]
    public function landingPage(EntityManagerInterface $entityManager) {
        if ($this->getUser()) {

            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

            $traineeRepo = $entityManager->getRepository(Trainee::class);
            $trainerRepo = $entityManager->getRepository(Trainer::class);
            $trainingRepo = $entityManager->getRepository(Training::class);
            $sessionRepo = $entityManager->getRepository(Session::class);
    
            $traineeCount = $traineeRepo->count([]);
            $trainerCount = $trainerRepo->count([]);
            $trainingCount = $trainingRepo->count([]);

            $incomingSessions = $sessionRepo->findIncomingSessions();
            $inProgressSessions =  $sessionRepo->findInProgressSessions();
            $passedSessions =  $sessionRepo->findPassedSessions();

            return $this->render('security/home.html.twig', [
                'traineeCount' => $traineeCount,
                'trainerCount' => $trainerCount,
                'trainingCount' => $trainingCount,
                'incSessions' => $incomingSessions,
                'inProgressSessions' => $inProgressSessions,
                'passedSessions' => $passedSessions
            ]);
        }
        else {
            return $this->render('/landingPage.html.twig');
        }
    }


    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            $this->addFlash('success', 'Connecté');
            return $this->redirectToRoute('app_home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }


    #[Route(path: '/home', name: 'app_home')]
    public function home(EntityManagerInterface $entityManager): Response
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $traineeRepo = $entityManager->getRepository(Trainee::class);
        $trainerRepo = $entityManager->getRepository(Trainer::class);
        $trainingRepo = $entityManager->getRepository(Training::class);
        $sessionRepo = $entityManager->getRepository(Session::class);

        $traineeCount = $traineeRepo->count([]);
        $trainerCount = $trainerRepo->count([]);
        $trainingCount = $trainingRepo->count([]);

        $incomingSessions = $sessionRepo->findIncomingSessions();
        $inProgressSessions =  $sessionRepo->findInProgressSessions();
        $passedSessions =  $sessionRepo->findPassedSessions();

        return $this->render('security/home.html.twig', [
            'traineeCount' => $traineeCount,
            'trainerCount' => $trainerCount,
            'trainingCount' => $trainingCount,
            'incSessions' => $incomingSessions,
            'inProgressSessions' => $inProgressSessions,
            'passedSessions' => $passedSessions
        ]);
    }

}
