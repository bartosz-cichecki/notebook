<?php

declare(strict_types=1);

namespace Notebook\Note\Application\Projection\Note;

interface NoteProjectionInterface
{
    public function findOne(NoteFilter $filter): ?NoteDto;
}
