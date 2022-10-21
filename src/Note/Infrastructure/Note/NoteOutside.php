<?php

declare(strict_types=1);

namespace Notebook\Note\Infrastructure\Note;

use Notebook\Common\Infrastructure\EventPublisher\EventPublisherServiceInterface;
use Notebook\Note\Domain\Note\Outside\NoteOutsideInterface;

final class NoteOutside implements NoteOutsideInterface
{
    private EventPublisherServiceInterface $eventPublisherService;

    public function __construct(
        EventPublisherServiceInterface $eventPublisherService
    ) {
        $this->eventPublisherService = $eventPublisherService;
    }

    public function publishEvent(object $event): void
    {
        $this->eventPublisherService->publish($event);
    }
}
