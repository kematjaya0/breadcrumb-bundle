<?php

namespace Kematjaya\Tests\Breadcrumb\Utils;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Container implements ContainerInterface
{

    public function set(string $id, ?object $service): void
    {
        // TODO: Implement set() method.
    }

    public function get(string $id, int $invalidBehavior = self::EXCEPTION_ON_INVALID_REFERENCE): ?object
    {
        // TODO: Implement get() method.
    }

    public function has(string $id): bool
    {
        // TODO: Implement has() method.
    }

    public function initialized(string $id): bool
    {
        // TODO: Implement initialized() method.
    }

    public function getParameter(string $name): array|bool|float|int|null|string|\UnitEnum
    {
        // TODO: Implement getParameter() method.
    }

    public function hasParameter(string $name): bool
    {
        // TODO: Implement hasParameter() method.
    }

    public function setParameter(string $name, \UnitEnum|float|array|bool|int|string|null $value): void
    {
        // TODO: Implement setParameter() method.
    }
}