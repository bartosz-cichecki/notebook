<?php

declare(strict_types=1);

namespace Notebook\Common\Infrastructure\Doctrine\EventListener;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionNamedType;

final class DependencyLoader
{
    private const DEPENDENCIES = [
        'FactoryInterface',
        'OutsideInterface',
    ];

    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function postLoad(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        try {
            $reflection = new ReflectionClass(\get_class($entity));
            $properties = $reflection->getProperties();

            foreach ($properties as $property) {
                /** @var ReflectionNamedType|null $propertyType */
                $propertyType = $property->getType();

                if ($propertyType === null) {
                    continue;
                }

                $dependencyClass = $propertyType->getName();
                if ($this->isDependencyField($dependencyClass) === false) {
                    continue;
                }
                if ($this->container->has($dependencyClass) === false) {
                    throw new \Exception(sprintf('Service: %s not exist as public', $dependencyClass));
                }

                $property->setAccessible(true);
                $property->setValue(
                    $entity,
                    $this->container->get($dependencyClass)
                );
                $property->setAccessible(false);
            }
        } catch (\Throwable $exception) {
            throw new \Exception(sprintf('Dependency injection failed. Class name: %s', \get_class($entity)));
        }
    }

    private function isDependencyField(string $dependencyClass): bool
    {
        foreach (self::DEPENDENCIES as $dependency) {
            if (strpos($dependencyClass, $dependency) !== false) {
                return true;
            }
        }

        return false;
    }
}
