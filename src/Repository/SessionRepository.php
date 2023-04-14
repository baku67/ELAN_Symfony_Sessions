<?php

namespace App\Repository;

use App\Entity\Session;

use Doctrine\ORM\Query\Parameter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Session>
 *
 * @method Session|null find($id, $lockMode = null, $lockVersion = null)
 * @method Session|null findOneBy(array $criteria, array $orderBy = null)
 * @method Session[]    findAll()
 * @method Session[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

    // Récupération des listes de session (A venir, en cours, passées) globales sur /home
    public function findPassedSessions() {
        $qb = $this->createQueryBuilder('a');

        $qb->where('a.begin_date < :now')
           ->andWhere('a.end_date < :now')
           ->setParameters(new ArrayCollection(array(
                new Parameter('now', new \DateTime() )
            )));

        return $qb->getQuery()->getResult();
    }

    public function findInProgressSessions() {
        $qb = $this->createQueryBuilder('a');

        $qb->where('a.begin_date < :now')
           ->andWhere('a.end_date > :now2')
           ->setParameters(new ArrayCollection(array(
                new Parameter('now', new \DateTime()),
                new Parameter('now2', new \DateTime())
            )));

        return $qb->getQuery()->getResult();
    }

    public function findIncomingSessions() {
        $qb = $this->createQueryBuilder('a');

        $qb->where('a.begin_date > :now')
           ->setParameters(new ArrayCollection(array(
                new Parameter('now', new \DateTime() )
            )));

        return $qb->getQuery()->getResult();
    }






    // Récupération des listes de session (A venir, en cours, passées) pour un Trainee (traineeDetail)
    public function findPassedSessionsByTrainee(int $traineeId) {

        // Custom query: https://symfony.com/doc/current/doctrine/associations.html#joining-related-records
        // $entityManager = $this->getEntityManager();
        // $query = $entityManager->createQuery(
        //     'SELECT s, t
        //     FROM App\Entity\TraineeSession s
        //     INNER JOIN s.'
        // )->setParameter('trainee', $traineeId);
        // return $query->getOneOrNullResult();

        $qb = $this->createQueryBuilder('a');
        $qb->where('a.begin_date < :now')
           ->andWhere('a.end_date < :now')
           ->andWhere('a.training = :trainingId')
           ->setParameters(new ArrayCollection(array(
                new Parameter('now', new \DateTime()),
                new Parameter('trainingId', $trainingId)
            )));

        return $qb->getQuery()->getResult();
    }

    public function findOngoingSessionsByTrainee(int $traineeId) {

        // Custom query: https://symfony.com/doc/current/doctrine/associations.html#joining-related-records
        $qb = $this->createQueryBuilder('a');
        $qb->where('a.begin_date < :now')
           ->andWhere('a.end_date > :now2')
           ->andWhere('a.training = :trainingId')
           ->setParameters(new ArrayCollection(array(
                new Parameter('now', new \DateTime()),
                new Parameter('now2', new \DateTime()),
                new Parameter('trainingId', $trainingId)
            )));

        return $qb->getQuery()->getResult();
    }
    
    public function findIncomingSessionsByTrainee(int $traineeId) {

        // Custom query: https://symfony.com/doc/current/doctrine/associations.html#joining-related-records
        $qb = $this->createQueryBuilder('a');

        $qb->where('a.begin_date > :now')
           ->andWhere('a.training = :trainingId')
           ->setParameters(new ArrayCollection(array(
                new Parameter('now', new \DateTime()),
                new Parameter('trainingId', $trainingId)
            )));

        return $qb->getQuery()->getResult();
    }















    // Récupération des listes de session (A venir, en cours, passées) pour un Training (trainingDetail)
    public function findPassedSessionByTraining(int $trainingId) {
        $qb = $this->createQueryBuilder('a');

        $qb->where('a.begin_date < :now')
           ->andWhere('a.end_date < :now')
           ->andWhere('a.training = :trainingId')
           ->setParameters(new ArrayCollection(array(
                new Parameter('now', new \DateTime()),
                new Parameter('trainingId', $trainingId)
            )));

        return $qb->getQuery()->getResult();
    }

    public function findOngoingSessionByTraining(int $trainingId) {
        $qb = $this->createQueryBuilder('a');

        $qb->where('a.begin_date < :now')
           ->andWhere('a.end_date > :now2')
           ->andWhere('a.training = :trainingId')
           ->setParameters(new ArrayCollection(array(
                new Parameter('now', new \DateTime()),
                new Parameter('now2', new \DateTime()),
                new Parameter('trainingId', $trainingId)
            )));

        return $qb->getQuery()->getResult();
    }

    public function findIncomingSessionByTraining(int $trainingId) {
        $qb = $this->createQueryBuilder('a');

        $qb->where('a.begin_date > :now')
           ->andWhere('a.training = :trainingId')
           ->setParameters(new ArrayCollection(array(
                new Parameter('now', new \DateTime()),
                new Parameter('trainingId', $trainingId)
            )));

        return $qb->getQuery()->getResult();
    }




    public function save(Session $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Session $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Session[] Returns an array of Session objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Session
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
