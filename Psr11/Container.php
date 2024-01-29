<?php

declare(strict_types=1);

namespace Phphleb\PsrAdapter\Psr11;

use Phphleb\PsrAdapter\Psr11\Exception\ContainerException;
use Phphleb\PsrAdapter\Psr11\Exception\NotFoundException;

class Container implements IntermediateContainerInterface
{
    public function __construct(private readonly object $container)
    {
    }

    /**
     * @inheritDoc
     */
    #[\Override]
    public function get(string $id): mixed
    {
        try {
            $container = $this->container->get($id);
        } catch (\Throwable $e) {
            throw new ContainerException("Error requesting container ($id): " . $e->getMessage(), previous: $e);
        }
        if ($container === null) {
            throw new NotFoundException("No entry was found for `$id` identifier");
        }

        return $container;
    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * Возвращает true, если контейнер может вернуть запись для данного идентификатора.
     * В противном случае возвращает false.
     */
    #[\Override]
    public function has(string $id): bool
    {
        try {
            return $this->container->has($id);
        } catch (\Throwable $e) {
            throw new ContainerException("Error checking container ($id): " . $e->getMessage(), previous: $e);
        }
    }
}