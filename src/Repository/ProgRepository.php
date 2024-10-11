<?php

namespace App\Repository;

use App\Entity\Prog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Prog>
 */
class ProgRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prog::class);
    }

    //Méthode personalisée pour la page d'accueil : renvoie 3 artistes au hasard pour donner un avant-goût la programmation
    public function findRandomArtists($limit = 3)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM prog
            ORDER BY RAND()
            LIMIT :limit
        ';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue('limit', $limit, \PDO::PARAM_INT);
        $resultSet = $stmt->executeQuery();

        // renvoie un tableau de tableaux (c'est-à-dire un ensemble de données brut)
        return $resultSet->fetchAllAssociative();
    }
}
