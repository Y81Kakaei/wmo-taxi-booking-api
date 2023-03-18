<?php

namespace App\Repository;

use App\Entity\TaxiCompany;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TaxiCompany>
 *
 * @method TaxiCompany|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaxiCompany|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaxiCompany[]    findAll()
 * @method TaxiCompany[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaxiCompanyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaxiCompany::class);
    }

    public function save(TaxiCompany $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TaxiCompany $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
