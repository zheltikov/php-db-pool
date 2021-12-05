<?php

namespace Zheltikov\Db;

use PDO;

/**
 *
 */
class Connection
{
    /**
     * @var mixed|null
     */
    protected $config = null;

    /**
     * @var \PDO
     */
    protected PDO $pdo;

    /**
     * @param mixed|null $config
     */
    public function __construct($config = null)
    {
        $this->setConfig($config);
    }

    /**
     * @param mixed|null $config
     * @return $this
     */
    public function setConfig($config = null): self
    {
        $this->config = $config;

        return $this;
    }

    public function open(): bool
    {
        // TODO
        return false;
    }

    public function close(): bool
    {
        // TODO
        return false;
    }

    /**
     * @return \Zheltikov\Db\QueryInterface
     */
    public function getQuery(): QueryInterface
    {
        return QueryFactory::get($this);
    }

    /**
     * @return string
     */
    public function getScheme(): string
    {
        // TODO
        return 'unknown';
    }
}

