<?php

declare(strict_types=1);

namespace Notebook\Common\Infrastructure\EventPublisher;

use Symfony\Component\Messenger\MessageBusInterface;

final class EventPublisherService implements EventPublisherServiceInterface
{
    /** @var object[] */
    private array $events = [];

    private MessageBusInterface $eventBus;

    public function __construct(MessageBusInterface $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function publish(object $event): void
    {
        $this->events[] = $event;
    }

    public function flush(): void
    {
        foreach ($this->events as $event) {
            $this->eventBus->dispatch($event);
        }
    }
}
