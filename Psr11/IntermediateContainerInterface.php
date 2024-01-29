<?php

namespace Phphleb\PsrAdapter\Psr11;

use Psr\Container\ContainerInterface;

interface IntermediateContainerInterface extends ContainerInterface
{
    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * Находит данные контейнера по его идентификатору и возвращает их.
     *
     * @template TContainerInterface
     * @param class-string<TContainerInterface> $id
     * @return TContainerInterface|mixed
     */
    #[\Override]
    public function get(string $id): mixed;
}