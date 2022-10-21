<?php

declare(strict_types=1);

namespace Notebook\Common\Application\Service\IdGenerator;

use Notebook\Common\Domain\Id\Id;

interface IdGeneratorServiceInterface
{
    public function create(): Id;
}
