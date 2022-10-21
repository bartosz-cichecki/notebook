<?php

declare(strict_types=1);

namespace Notebook\Note\Domain\Note\Event;

use Notebook\Common\Domain\Id\Id;

final class NoteUpdated
{
    private Id $id;
    private string $oldContent;
    private string $newContent;
    private int $updateCounter;
    private \DateTime $updatedAt;

    public function __construct(
        Id $id,
        string $oldContent,
        string $newContent,
        int $updateCounter,
        \DateTime $updatedAt,
    ) {
        $this->id = $id;
        $this->oldContent = $oldContent;
        $this->newContent = $newContent;
        $this->updateCounter = $updateCounter;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getOldContent(): string
    {
        return $this->oldContent;
    }

    public function getNewContent(): string
    {
        return $this->newContent;
    }

    public function getUpdateCounter(): int
    {
        return $this->updateCounter;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
}
