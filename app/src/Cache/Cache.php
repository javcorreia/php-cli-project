<?php

namespace App\Cli\Cache;

use Symfony\Component\Cache\Adapter\RedisAdapter;

class Cache
{
    protected static RedisAdapter $instance;
    protected static $instanceConnection;

    protected static function initializeCacheAdapter(): void
    {
        $redisConnectionString = "redis://{$_ENV['REDIS_HOST']}:{$_ENV['REDIS_PORT']}/1";
        self::$instanceConnection = RedisAdapter::createConnection($redisConnectionString);
        self::$instance = new RedisAdapter(self::$instanceConnection, "pla_");
    }

    public static function getCache(): RedisAdapter
    {
        if (!isset(self::$instance)) {
            self::initializeCacheAdapter();
        }

        return self::$instance;
    }

    public static function getConnection()
    {
        if (!isset(self::$instanceConnection)) {
            self::initializeCacheAdapter();
        }

        return self::$instanceConnection;
    }

    public static function get(string $key, $default=null): mixed
    {
        $cacheItem = self::getCache()->getItem($key);

        if (!$cacheItem->isHit()) {
            return $default;
        }

        return $cacheItem->get();
    }

    public static function set(string $key, $value, int $ttl=0): bool
    {
        $cacheItem = self::getCache()->getItem($key);
        $cacheItem->set($value);
        if ($ttl > 0) {
            $cacheItem->expiresAfter($ttl);
        }
        return self::getCache()->save($cacheItem);
    }

    public static function delete(string $key): bool
    {
        return self::getCache()->deleteItem($key);
    }
}