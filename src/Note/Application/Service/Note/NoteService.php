<?php

declare(strict_types=1);

namespace Notebook\Note\Application\Service\Note;

use Notebook\Common\Domain\Id\Id;
use Notebook\Common\Infrastructure\TransactionManager\TransactionManagerService;
use Notebook\Note\Application\Projection\Note\NoteDto;
use Notebook\Note\Application\Projection\Note\NoteFilter;
use Notebook\Note\Application\Projection\Note\NoteProjectionInterface;
use Notebook\Note\Domain\Note\Factory\NoteFactoryInterface;
use Notebook\Note\Domain\Note\Repository\NoteRepositoryInterface;

final class NoteService implements NoteServiceInterface
{
    private TransactionManagerService $transactionManager;
    private NoteFactoryInterface $noteFactory;
    private NoteRepositoryInterface $noteRepository;
    private NoteProjectionInterface $noteProjection;

    public function __construct(
        TransactionManagerService $transactionManager,
        NoteFactoryInterface $noteFactory,
        NoteRepositoryInterface $noteRepository,
        NoteProjectionInterface $noteProjection
    ) {
        $this->transactionManager = $transactionManager;
        $this->noteFactory = $noteFactory;
        $this->noteRepository = $noteRepository;
        $this->noteProjection = $noteProjection;
    }

    public function create(
        Id $id,
        string $name,
        string $content,
    ): void {
        $note = $this->noteFactory->create(
            $id,
            $name,
            $content
        );
        $this->noteRepository->create($note);
        $this->transactionManager->flush();
    }

    public function update(
        Id $id,
        string $content,
    ): void {
        $note = $this->noteRepository->get($id);
        $note->assignNewContent($content);
        $this->transactionManager->flush();
    }

    public function findOne(
        NoteFilter $filter
    ): ?NoteDto {
        return $this->noteProjection->findOne($filter);
    }
}
