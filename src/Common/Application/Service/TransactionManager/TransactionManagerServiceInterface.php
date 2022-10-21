<?php

declare(strict_types=1);

namespace Notebook\Common\Application\Service\TransactionManager;

interface TransactionManagerServiceInterface
{
    public function flush(): void;
}
