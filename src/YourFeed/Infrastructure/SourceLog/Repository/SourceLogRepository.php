<?php

declare(strict_types=1);

namespace Ferdyrurka\YourFeed\Infrastructure\SourceLog\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ferdyrurka\YourFeed\Infrastructure\SourceLog\Entity\SourceLog;

class SourceLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SourceLog::class);
    }

    public function add(SourceLog $log): void
    {
        $this->_em->persist($log);
    }
}
