<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ferdyrurka\YourFeed\Domain\Entity\Source;
use Ferdyrurka\YourFeed\Domain\Enum\Period;

/**
 * @extends ServiceEntityRepository<Source>
 *
 * @method Source|null find($id, $lockMode = null, $lockVersion = null)
 * @method Source|null findOneBy(array $criteria, array $orderBy = null)
 * @method Source[]    findAll()
 * @method Source[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SourceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Source::class);
    }

    public function findByPeriod(Period $period): array
    {
        return $this->findBy(['period' => $period->value]);
    }
}
