<?php

declare(strict_types=1);

namespace Notebook\Note\Application\Projection\Note;

use Notebook\Common\Domain\Id\Id;

final class NoteFilter
{
    private ?Id $id = null;
    private ?string $name = null;

    private function __construct()
    {
    }

    public static function create(): self
    {
        return new self();
    }

    public function getId(): ?Id
    {
        return $this->id;
    }

    public function setId(?Id $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
