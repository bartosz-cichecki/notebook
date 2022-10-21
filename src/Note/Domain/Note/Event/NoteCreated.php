<?php

declare(strict_types=1);

namespace Notebook\Note\Domain\Note\Event;

use Notebook\Common\Domain\Id\Id;

final class NoteCreated
{
    private Id $id;
    private string $name;
    private string $content;
    private \DateTime $createdAt;

    public function __construct(
        Id $id,
        string $name,
        string $content,
        \DateTime $createdAt,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->content = $content;
        $this->createdAt = $createdAt;
    }

    public function getId(): Id
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

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
}
