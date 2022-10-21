<?php

declare(strict_types=1);

namespace Notebook\Note\Domain\Note\Repository;

use Notebook\Common\Domain\Id\Id;
use Notebook\Note\Domain\Note\Note;
use Notebook\Note\Domain\Note\Repository\Exception\NoteDoesNotExistException;

interface NoteRepositoryInterface
{
    public function create(Note $note): void;

    /**
     * @throws NoteDoesNotExistException
     */
    public function get(Id $id): Note;
}
