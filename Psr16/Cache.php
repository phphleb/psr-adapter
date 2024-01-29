<?php

declare(strict_types=1);

namespace Phphleb\PsrAdapter\Psr16;

use Hleb\Static\Cache as BaseCache;
use Phphleb\PsrAdapter\Psr16\Exception\CacheException;
use Phphleb\PsrAdapter\Psr16\Exception\InvalidArgumentException;
use Psr\SimpleCache\CacheInterface;

class Cache implements CacheInterface
{
    /**
     * @inheritDoc
     */
    public function get(string $key, mixed $default = null): mixed
    {
        $key = $this->convertKey($key);
        try {
            return BaseCache::get($key, $default);
        } catch (\Exception $t) {
            throw new CacheException($t->getMessage(), previous: $t);
        }
    }

    /**
     * @inheritDoc
     */
    public function set(string $key, mixed $value, \DateInterval|int|null $ttl = null): bool
    {
        $key = $this->convertKey($key);
        try {
            if ($ttl === null) {
                return BaseCache::set($key, $value);
            }
            if (is_object($ttl)) {
                $ttl = date_create('@0')->add($ttl)->getTimestamp();
            }
            return BaseCache::set($key, $value, $ttl);
        } catch (\Exception $t) {
            throw new CacheException($t->getMessage(), previous: $t);
        }
    }

    /**
     * @inheritDoc
     */
    public function delete(string $key): bool
    {
        $key = $this->convertKey($key);
        try {
            return BaseCache::delete($key);
        } catch (\Exception $t) {
            throw new CacheException($t->getMessage(), previous: $t);
        }
    }

    /**
     * @inheritDoc
     */
    public function clear(): bool
    {
        try {
            return BaseCache::clear();
        } catch (\Exception $t) {
            throw new CacheException($t->getMessage(), previous: $t);
        }
    }

    /**
     * @inheritDoc
     */
    public function getMultiple(iterable $keys, mixed $default = null): iterable
    {
        $keys = $this->convertKeys($keys);
        try {
            return BaseCache::getMultiple($keys, $default);
        } catch (\Exception $t) {
            throw new CacheException($t->getMessage(), previous: $t);
        }
    }

    /**
     * @inheritDoc
     */
    public function setMultiple(iterable $values, \DateInterval|int|null $ttl = null): bool
    {
        try {
            if ($ttl === null) {
                return BaseCache::setMultiple(iterator_to_array($values));
            }
            if (is_object($ttl)) {
                $ttl = date_create('@0')->add($ttl)->getTimestamp();
            }
            return BaseCache::setMultiple(iterator_to_array($values), $ttl);
        } catch (\Exception $t) {
            throw new CacheException($t->getMessage(), previous: $t);
        }
    }

    /**
     * @inheritDoc
     */
    public function deleteMultiple(iterable $keys): bool
    {
        $keys = $this->convertKeys($keys);
        try {
            return BaseCache::deleteMultiple($keys);
        } catch (\Exception $t) {
            throw new CacheException($t->getMessage(), previous: $t);
        }
    }

    /**
     * @inheritDoc
     */
    public function has(string $key): bool
    {
        try {
            return BaseCache::has($key);
        } catch (\Exception $t) {
            throw new CacheException($t->getMessage(), previous: $t);
        }
    }

    private function convertKeys(iterable $keys): array
    {
        $result = [];
        foreach ($keys as $key) {
            $result[] = $this->convertKey($key);
        }
        return $result;
    }

    /**
     * @throws InvalidArgumentException
     */
    private function convertKey(string $key): string
    {
        if (!$this->has($key)) {
            throw new InvalidArgumentException();
        }
        return $key;
    }
}