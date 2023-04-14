<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
// use Doctrine\ORM\PersistentCollection;
use App\Entity\Session;
use App\Entity\Training;
use App\Entity\Programme;
use App\Entity\Trainee;
use App\Entity\Module;
use App\Form\SessionType;
use App\Form\ProgrammeType;

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
    public function sessionDetail(EntityManagerInterface $entityManager, int $id, Request $request): Response {
        
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $sessionRepo = $entityManager->getRepository(Session::class);
        $traineeRepo = $entityManager->getRepository(Trainee::class);
        $moduleRepo = $entityManager->getRepository(Module::class);

        $session = $sessionRepo->find($id);

        $susbcribedTrainees = $session->getTrainees();
        // PersistentCollection (entités avec relation) to array d'objets
        $susbcribedTraineesArray = $susbcribedTrainees->toArray();
        $nbrSubscribers = count($susbcribedTrainees);

        $allTrainees = $traineeRepo->findAll();

        // Pour enlever les stagiaires deja inscrits de la liste des stagiaires dispo
        $notSubTrainees = array_diff($allTrainees, $susbcribedTraineesArray);
        // $notSubTrainees = array_filter($allTrainees, function($trainee) {
        //     if (!in_array($trainee, $susbcribedTrainees)) {
                
        //     }
        // });
        // https://www.w3schools.com/php/func_array_filter.asp

        $allModules = $moduleRepo->findAll(); 
        $sessionProgrammes = $session->getProgrammes();

        // Tableau des modules deja ajouté dans la programmation (pour empecher doublons)
        $sessionModules = [];
        foreach ($sessionProgrammes as $sessionProgramme) {
            $sessionModules[] = $sessionProgramme->getModule();
        }

        // form ajout d'un programme à la session
        $programme = new Programme();
        $form = $this->createForm(ProgrammeType::class, $programme);
        $form -> handleRequest($request);

        // Vérifs/Filtres
        if($form->isSubmitted()) {

            if( in_array($programme->getModule(), $sessionModules) ) {
                // Le module que l'on veut ajouter à la session est déjà présent dans le programme
                $this->addFlash('error', 'Le module est déjà présent dans la programmation de la session');
                return $this->redirectToRoute('app_sessionDetail', array('id' => $id) );
            }
            else {

                if($form->isValid()) {

                

                    // Hydrataion "Entreprise $entreprise" a partir des données du form
                    $programme = $form->getData();
                    // Equivalent au prepare et execute PDO (persist() avant si ajout en BDD !)
                    $entityManager->persist($programme);
                    $entityManager->flush();
    
                    // On récupère l'id de la formation "mère" pour rediriger vers Détail formation
                    $this->addFlash('success', 'Le module à bien été ajouté à la programmation');
                    return $this->redirectToRoute('app_sessionDetail', array('id' => $id) );
                }    
            }

        }

        return $this->render('session/sessionDetail.html.twig', [
            'session' => $session,
            'subTrainees' => $susbcribedTrainees,
            'nbrSubscribers' => $nbrSubscribers,
            'allTrainees' => $allTrainees,
            'notSubTrainees' => $notSubTrainees,
            'allModules' => $allModules,
            'sessionProgrammes' => $sessionProgrammes,
            'formAddProgramme' => $form->createView(),
        ]);

    }



    #[Route('/session/{id}/app_deleteProgram/{idProgram}', name: 'app_deleteProgram')]
    public function deleteProgram(EntityManagerInterface $entityManager, int $id, int $idProgram, Request $request): Response  {

        // Méthode rapide pour savoir si User connecté
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $sessionRepo = $entityManager->getRepository(Session::class);
        $programRepo = $entityManager->getRepository(Programme::class);

        $session = $sessionRepo->find($id);
        $program = $programRepo->find($idProgram);

        $session->removeProgramme($program);
        $programRepo->remove($program, true);

        $this->addFlash('success', 'Le module à bien été supprimé de la programmation');
        return $this->redirectToRoute('app_sessionDetail', array('id' => $id) );
    }






    // Gère l'affichage du form d'ajout/modification MAIS GERE AUSSI l'envoi du form (if isSubmitted  ou juste affichage form )
    #[Route('/session/{id}/edit', name: 'app_editSession')]
    #[Route('/session/{idTraining}/add', name: 'app_addSession')]
    public function add(EntityManagerInterface $entityManager, int $idTraining = null, Session $session = null, Request $request): Response  {

        // Méthode rapide pour savoir si User connecté
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // On vérifie dans quel cas on est (création ou modification de l'entité)
        if(!$session) {
            $flashMsg = "La session a bien été ajoutée";
            $session = new Session();
        }
        else {
            $flashMsg = "Modifications sauvegardées";
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
                $this->addFlash('success', $flashMsg);
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

        $this->addFlash('success', 'La session a bien été supprimé');
        return $this->redirectToRoute('app_home');

    }



}
