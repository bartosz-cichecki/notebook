<?php

declare(strict_types=1);

namespace Notebook\Common\Infrastructure\IdGenerator;

use Notebook\Common\Application\Service\IdGenerator\IdGeneratorServiceInterface;
use Notebook\Common\Domain\Id\Id;
use Ramsey\Uuid\Uuid;

final class IdGeneratorService implements IdGeneratorServiceInterface
{
    public function create(): Id
    {
        return new Id(
            Uuid::uuid4()->toString()
        );
    }
}
