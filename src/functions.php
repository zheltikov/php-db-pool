<?php

namespace Zheltikov\Db;

function fetch(Pool $pool, string $name, string $sql, array $params): array
{
    return $pool->getConnection($name)
        ->getQuery()
        ->setSql($sql)
        ->setParams($params)
        ->fetch();
}

