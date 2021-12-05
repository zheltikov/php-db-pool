<?php

namespace Zheltikov\Db;

use Generator;
use PDOStatement;

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
     * @return \Zheltikov\Db\Connection
     */
    public function getConnection(): Connection;

    /**
     * @return $this
     */
    public function reset(): self;

    /**
     * @return string
     */
    public function getSql(): string;

    /**
     * @param string $sql
     * @return $this
     */
    public function setSql(string $sql): self;

    /**
     * @return array
     */
    public function getParams(): array;

    /**
     * @param string $param
     * @param mixed $value
     * @return $this
     */
    public function setParam(string $param, $value): self;

    /**
     * @param array $params
     * @return $this
     */
    public function setParams(array $params): self;

    /**
     * @return array
     */
    public function fetch(): array;

    /**
     * @return \Generator
     */
    public function fetchGenerator(): Generator;

    /**
     * @param array|null $params
     * @return int
     */
    public function execute(?array $params = null): int;

    /**
     * @return $this
     */
    public function prepare(): self;

    /**
     * @return string
     */
    public function getLastInsertId(): string;

    /**
     * @return \PDOStatement
     */
    public function getStatement(): PDOStatement;
}
