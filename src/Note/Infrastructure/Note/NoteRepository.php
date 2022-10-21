<?php

declare(strict_types=1);

namespace Notebook\Note\Infrastructure\Note;

use Doctrine\ORM\EntityManagerInterface;
use Notebook\Common\Domain\Id\Id;
use Notebook\Note\Domain\Note\Note;
use Notebook\Note\Domain\Note\Repository\Exception\NoteDoesNotExistException;
use Notebook\Note\Domain\Note\Repository\NoteRepositoryInterface;

final class NoteRepository implements NoteRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(Note $note): void
    {
        $this->entityManager->persist($note);
    }

    public function get(Id $id): Note
    {
        $note = $this->entityManager->find(Note::class, $id);

        if ($note === null) {
            throw new NoteDoesNotExistException($id);
        }

        return $note;
    }
}
