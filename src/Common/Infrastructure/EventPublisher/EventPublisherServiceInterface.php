<?php

declare(strict_types=1);

namespace Notebook\Common\Infrastructure\EventPublisher;

interface EventPublisherServiceInterface
{
    public function publish(object $event): void;

    public function flush(): void;
}
