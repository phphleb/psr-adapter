<?php

namespace Phphleb\PsrAdapter\Psr11\Exception;

use Psr\Container\ContainerExceptionInterface;

class ContainerException extends \RuntimeException implements ContainerExceptionInterface
{
}