<?php

declare(strict_types=1);

namespace Notebook\Common\Infrastructure\Test\TestHelper;

interface TestHelperServiceInterface
{
    public function truncateTable(string $entityClass): void;
}
