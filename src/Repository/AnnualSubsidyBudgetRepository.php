<?php

namespace App\Repository;

use App\Entity\AnnualSubsidyBudget;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AnnualSubsidyBudget>
 *
 * @method AnnualSubsidyBudget|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnnualSubsidyBudget|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnnualSubsidyBudget[]    findAll()
 * @method AnnualSubsidyBudget[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnualSubsidyBudgetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnnualSubsidyBudget::class);
    }

    public function save(AnnualSubsidyBudget $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AnnualSubsidyBudget $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
