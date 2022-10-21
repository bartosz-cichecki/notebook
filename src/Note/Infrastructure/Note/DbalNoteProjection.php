<?php

declare(strict_types=1);

namespace Notebook\Note\Infrastructure\Note;

use Doctrine\ORM\EntityManagerInterface;
use Notebook\Note\Application\Projection\Note\NoteDto;
use Notebook\Note\Application\Projection\Note\NoteFilter;
use Notebook\Note\Application\Projection\Note\NoteProjectionInterface;
use Notebook\Note\Domain\Note\Note;

final class DbalNoteProjection implements NoteProjectionInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findOne(NoteFilter $filter): ?NoteDto
    {
        $queryBuilder = $this->entityManager
            ->getConnection()
            ->createQueryBuilder()
            ->select('note.*')
            ->from($this->entityManager->getClassMetadata(Note::class)->getTableName(), 'note');

        if ($filter->getId() !== null) {
            $queryBuilder
                ->andWhere('id = :id')
                ->setParameter('id', $filter->getId())
            ;
        }

        if ($filter->getName() !== null) {
            $queryBuilder
                ->andWhere('name = :name')
                ->setParameter('name', $filter->getName())
            ;
        }

        /** @var string[]|false $result */
        $result = $queryBuilder->fetchAssociative();

        if ($result === false) {
            return null;
        }

        return new NoteDto(
            $result['id'],
            $result['name'],
            $result['content'],
            (int) $result['update_counter'],
        );
    }
}
