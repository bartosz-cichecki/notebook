<?php

declare(strict_types=1);

namespace Notebook\Note\Domain\Note\Factory;

use Notebook\Common\Domain\Id\Id;
use Notebook\Note\Domain\Note\Note;

interface NoteFactoryInterface
{
    public function create(
        Id $id,
        string $name,
        string $content,
    ): Note;
}
