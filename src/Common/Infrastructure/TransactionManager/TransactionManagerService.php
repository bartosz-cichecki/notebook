<?php

declare(strict_types=1);

namespace Notebook\Common\Infrastructure\TransactionManager;

use Doctrine\ORM\EntityManagerInterface;
use Notebook\Common\Application\Service\TransactionManager\TransactionManagerServiceInterface;
use Notebook\Common\Infrastructure\EventPublisher\EventPublisherServiceInterface;

final class TransactionManagerService implements TransactionManagerServiceInterface
{
    private EntityManagerInterface $entityManager;
    private EventPublisherServiceInterface $eventPublisherService;

    public function __construct(
        EntityManagerInterface $entityManager,
        EventPublisherServiceInterface $eventPublisherService
    ) {
        $this->entityManager = $entityManager;
        $this->eventPublisherService = $eventPublisherService;
    }

    public function flush(): void
    {
        $this->entityManager->beginTransaction();
        try {
            $this->entityManager->flush();
            $this->eventPublisherService->flush();
            $this->entityManager->commit();
            $this->entityManager->clear();
        } catch (\Throwable $exception) {
            $this->entityManager->rollback();

            throw $exception;
        }
    }
}
