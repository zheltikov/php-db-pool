<?php

namespace Zheltikov\Db;

/**
 *
 */
interface QueryInterface
{
    /**
     * @param \Zheltikov\Db\Connection $connection
     */
    public function __construct(Connection $connection);

    /**
     * @param string $sql
     * @return $this
     */
    public function setSql(string $sql): self;

    /**
     * @param array $params
     * @return $this
     */
    public function setParams(array $params): self;

    /**
     * @return array
     */
    public function fetch(): array;

    // public function fetchGenerator(): Generator;

    /**
     * @return bool
     */
    public function execute(): bool;
}
