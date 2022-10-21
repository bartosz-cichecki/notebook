<?php

declare(strict_types=1);

namespace Notebook\Common\Infrastructure\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use Notebook\Common\Domain\Id\Id;

class IdType extends Type
{
    private const NAME = 'id';

    /**
     * {@inheritdoc}
     */
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        if ($platform->hasNativeGuidType()) {
            return $platform->getGuidTypeDeclarationSQL($column);
        }

        return $platform->getBinaryTypeDeclarationSQL([
            'length' => '16',
            'fixed' => true,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value instanceof Id) {
            return $value->getValue();
        }

        if ($value === null || $value === '') {
            return null;
        }

        throw ConversionException::conversionFailedInvalidType($value, $this->getName(), ['null', 'string', Id::class]);
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Id
    {
        if ($value instanceof Id
            || $value === null
        ) {
            return $value;
        }

        if (\is_string($value)) {
            return new Id($value);
        }

        throw ConversionException::conversionFailedInvalidType($value, $this->getName(), ['null', 'string', Id::class]);
    }

    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
