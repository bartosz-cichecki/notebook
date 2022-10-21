<?php

declare(strict_types=1);

namespace Notebook\Note\Domain\Note\Factory;

use Notebook\Common\Domain\Id\Id;
use Notebook\Note\Domain\Note\Note;
use Notebook\Note\Domain\Note\Outside\NoteOutsideInterface;

final class NoteFactory implements NoteFactoryInterface
{
    private NoteOutsideInterface $outside;

    public function __construct(NoteOutsideInterface $outside)
    {
        $this->outside = $outside;
    }

    public function create(
        Id $id,
        string $name,
        string $content,
    ): Note {
        return new Note(
            $this->outside,
            $id,
            $name,
            $content,
        );
    }
}
