<?php

declare(strict_types=1);

namespace Notebook\Common\Domain\Id;

final class Id
{
    private string $value;

    public function __construct(string $id)
    {
        $this->value = $id;
    }

    public function equal(Id $id): bool
    {
        return $this->value === $id->value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
