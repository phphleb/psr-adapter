<?php

declare(strict_types=1);

namespace Phphleb\PsrAdapter\Psr3;

use Hleb\InvalidLogLevelException;
use Hleb\Main\Logger\Log as MainLogger;
use Hleb\Static\Log;
use Psr\Log\LoggerInterface;

final class Logger implements LoggerInterface
{
    /**
     * @inheritDoc
     */
    #[\Override]
    public function emergency(\Stringable|string $message, array $context = []): void
    {
        Log::emergency((string)$message, self::b7e($context));
    }

    /**
     * @inheritDoc
     */
    #[\Override]
    public function alert(\Stringable|string $message, array $context = []): void
    {
        Log::alert((string)$message, self::b7e($context));
    }

    /**
     * @inheritDoc
     */
    #[\Override]
    public function critical(\Stringable|string $message, array $context = []): void
    {
        Log::critical((string)$message, self::b7e($context));
    }

    /**
     * @inheritDoc
     */
    #[\Override]
    public function error(\Stringable|string $message, array $context = []): void
    {
        Log::error((string)$message, self::b7e($context));
    }

    /**
     * @inheritDoc
     */
    #[\Override]
    public function warning(\Stringable|string $message, array $context = []): void
    {
        Log::warning((string)$message, self::b7e($context));
    }

    /**
     * @inheritDoc
     */
    #[\Override]
    public function notice(\Stringable|string $message, array $context = []): void
    {
        Log::notice((string)$message, self::b7e($context));
    }

    /**
     * @inheritDoc
     */
    #[\Override]
    public function info(\Stringable|string $message, array $context = []): void
    {
        Log::info((string)$message, self::b7e($context));
    }

    /**
     * @inheritDoc
     */
    #[\Override]
    public function debug(\Stringable|string $message, array $context = []): void
    {
        Log::debug((string)$message, self::b7e($context));
    }

    /**
     * @inheritDoc
     */
    #[\Override]
    public function log($level, \Stringable|string $message, array $context = []): void
    {
        try {
            Log::log($level, (string)$message, self::b7e($context));
        } catch (InvalidLogLevelException) {
            throw new \Psr\Log\InvalidArgumentException("The `$level` logging level is not supported.");
        }
    }

    /**
     * The nesting level of the called log in the code to determine the file and call line.
     *
     * Уровень вложенности вызываемого лога в коде для определения файла и строки вызова.
     */
    private static function b7e(array $context): array
    {
        if (empty($context[MainLogger::B7E_NAME])) {
            $context[MainLogger::B7E_NAME] = MainLogger::WRAPPER_B7E;
        }

        return $context;
    }
}