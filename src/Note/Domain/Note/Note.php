<?php

declare(strict_types=1);

namespace Notebook\Note\Domain\Note;

use Notebook\Common\Domain\Id\Id;
use Notebook\Note\Domain\Note\Event\NoteCreated;
use Notebook\Note\Domain\Note\Event\NoteUpdated;
use Notebook\Note\Domain\Note\Outside\NoteOutsideInterface;

final class Note
{
    private NoteOutsideInterface $outside;
    private Id $id;
    private string $name;
    private string $content;
    private int $updateCounter = 0;

    public function __construct(
        NoteOutsideInterface $outside,
        Id $id,
        string $name,
        string $content,
    ) {
        $this->outside = $outside;
        $this->id = $id;
        $this->name = $name;
        $this->content = $content;

        $this->outside->publishEvent(
            new NoteCreated(
                $this->id,
                $this->name,
                $this->content,
                new \DateTime()
            )
        );
    }

    public function assignNewContent(
        string $content,
    ): void {
        $oldContent = $this->content;
        $this->content = $content;
        $this->updateCounter = ++$this->updateCounter;

        $this->outside->publishEvent(
            new NoteUpdated(
                $this->id,
                $oldContent,
                $this->content,
                $this->updateCounter,
                new \DateTime()
            )
        );
    }
}
