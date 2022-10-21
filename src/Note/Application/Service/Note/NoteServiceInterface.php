<?php

declare(strict_types=1);

namespace Notebook\Note\Application\Service\Note;

use Notebook\Common\Domain\Id\Id;
use Notebook\Note\Application\Projection\Note\NoteDto;
use Notebook\Note\Application\Projection\Note\NoteFilter;

interface NoteServiceInterface
{
    public function create(
        Id $id,
        string $name,
        string $content,
    ): void;

    public function update(
        Id $id,
        string $content,
    ): void;

    public function findOne(
        NoteFilter $filter
    ): ?NoteDto;
}
