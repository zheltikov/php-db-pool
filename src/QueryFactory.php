<?php

namespace Zheltikov\Db;

use Zheltikov\Db\Query\{MySQL, PostgreSQL,};
use RuntimeException;

/**
 *
 */
class QueryFactory
{
    /**
     * @var array<string, class-string<\Zheltikov\Db\QueryInterface>>
     */
    protected static $map = [
        'mysql' => MySQL::class,
        'pgsql' => PostgreSQL::class,
    ];

    /**
     * @param \Zheltikov\Db\Connection $connection
     * @return \Zheltikov\Db\QueryInterface
     */
    public static function get(Connection $connection): QueryInterface
    {
        if (!array_key_exists($connection->getScheme(), static::$map)) {
            throw new RuntimeException('No valid Query found for scheme!');
        }

        $class = static::$map[$connection->getScheme()];

        if (static::checkQueryClass($class)) {
            return new $class($connection);
        }

        throw new RuntimeException('Invalid Query map configuration!');
    }

    /**
     * @param string $scheme
     * @param class-string<\Zheltikov\Db\QueryInterface> $query
     */
    public static function setQuery(string $scheme, string $query): void
    {
        if (static::checkQueryClass($query)) {
            static::$map[$scheme] = $query;

            return;
        }

        throw new RuntimeException('Invalid Query class!');
    }

    /**
     * @param class-string $class
     * @return bool
     */
    protected static function checkQueryClass(string $class): bool
    {
        if (!class_exists($class)) {
            return false;
        }

        $implements = class_implements($class);

        if ($implements === false) {
            return false;
        }

        if (!in_array(QueryInterface::class, $implements, true)) {
            return false;
        }

        return true;
    }
}
