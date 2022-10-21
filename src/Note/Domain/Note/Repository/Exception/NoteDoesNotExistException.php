<?php

declare(strict_types=1);

namespace Notebook\Note\Domain\Note\Repository\Exception;

use Notebook\Common\Domain\Id\Id;

final class NoteDoesNotExistException extends \Exception
{
    public function __construct(Id $id)
    {
        parent::__construct(
            sprintf(
                'Note does not exist for id: %s',
                $id
            )
        );
    }
}
