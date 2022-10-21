<?php

declare(strict_types=1);

namespace Notebook\Note\Application\Projection\Note;

final class NoteDto
{
    private string $id;
    private string $name;
    private string $content;
    private int $updateCounter;

    public function __construct(
        string $id,
        string $name,
        string $content,
        int $updateCounter
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->content = $content;
        $this->updateCounter = $updateCounter;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getUpdateCounter(): int
    {
        return $this->updateCounter;
    }
}
