<?php

namespace Zheltikov\Db;

use RuntimeException;

/**
 * @param array{dsn: string, scheme: string} $c
 * @return \Zheltikov\Db\Config
 */
function config(array $c = []): Config
{
    if (!array_key_exists('dsn', $c)) {
        throw new RuntimeException('Field `dsn` is required!');
    }

    if (!array_key_exists('scheme', $c)) {
        throw new RuntimeException('Field `scheme` is required!');
    }

    $config = new Config($c['dsn'], $c['scheme']);

    if (array_key_exists('username', $c)) {
        $config->setUsername($c['username']);
    }

    if (array_key_exists('password', $c)) {
        $config->setPassword($c['password']);
    }

    if (array_key_exists('options', $c)) {
        $config->setOptions($c['options']);
    }

    return $config;
}

/**
 * @param array $c
 * @return \Zheltikov\Db\PoolConfig
 */
function poolConfig(array $c = []): PoolConfig
{
    $poolConfig = new PoolConfig();

    foreach ($c as $name => $config) {
        $poolConfig->set($name, config($config));
    }

    return $poolConfig;
}
