<?php

namespace Phphleb\PsrAdapter\Psr11\Exception;

use Psr\Container\NotFoundExceptionInterface;

class NotFoundException extends ContainerException implements NotFoundExceptionInterface
{

}