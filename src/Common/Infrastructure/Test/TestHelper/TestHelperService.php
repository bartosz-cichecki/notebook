<?php

declare(strict_types=1);

namespace Notebook\Common\Infrastructure\Test\TestHelper;

use Doctrine\ORM\EntityManagerInterface;

final class TestHelperService implements TestHelperServiceInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function truncateTable(string $entityClass): void
    {
        $classMetadata = $this->entityManager->getClassMetadata($entityClass);
        $connection = $this->entityManager->getConnection();
        $databasePlatform = $connection->getDatabasePlatform();
        $query = $databasePlatform->getTruncateTableSql($classMetadata->getTableName(), true);
        $connection->executeQuery($query);
    }
}
