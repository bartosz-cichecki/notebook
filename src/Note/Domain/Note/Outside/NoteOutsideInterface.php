<?php

declare(strict_types=1);

namespace Notebook\Note\Domain\Note\Outside;

interface NoteOutsideInterface
{
    public function publishEvent(object $event): void;
}
