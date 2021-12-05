<?php

namespace Zheltikov\Db\Query;

use Zheltikov\Db\Connection;
use Zheltikov\Db\QueryInterface;

/**
 *
 */
class PostgreSQL implements QueryInterface
{
    /**
     * @param \Zheltikov\Db\Connection $connection
     */
    public function __construct(Connection $connection)
    {
    }

    /**
     * @param string $sql
     * @return $this
     */
    public function setSql(string $sql): self
    {
        // TODO: Implement setSql() method.
        return $this;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function setParams(array $params): self
    {
        // TODO: Implement setParams() method.
        return $this;
    }

    /**
     * @return array
     */
    public function fetch(): array
    {
        // TODO: Implement fetch() method.
        return [];
    }

    /**
     * @return bool
     */
    public function execute(): bool
    {
        // TODO: Implement execute() method.
        return false;
    }
}
