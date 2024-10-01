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

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }
}
