<?php

namespace Zheltikov\Db\Query;

use Exception;
use PDO;
use PDOStatement;
use Zheltikov\Db\Connection;
use Zheltikov\Db\QueryInterface;

/**
 *
 */
class MySQL implements QueryInterface
{
    /**
     * @var \Zheltikov\Db\Connection
     */
    protected Connection $connection;

    /**
     * @var string
     */
    protected string $sql = '';

    /**
     * @var array
     */
    protected array $params = [];

    /**
     * @var \PDOStatement|null
     */
    protected ?PDOStatement $statement = null;

    // -------------------------------------------------------------------------

    /**
     * @param \Zheltikov\Db\Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->reset();
    }

    /**
     * @return $this
     */
    public function reset(): self
    {
        $this->sql = '';
        $this->params = [];
        $this->statement = null;

        return $this;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function fetch(): array
    {
        $this->prepare();

        $params = $this->getParams() ?: null;
        $result = $this->getStatement()->execute($params);

        if ($result === false) {
            [$sqlstate, $code, $message] = $this->getStatement()->errorInfo();
            throw new Exception($message ?: $sqlstate, $code);
        }

        $result = $this->getStatement()->fetchAll(PDO::FETCH_ASSOC);
        $this->getStatement()->closeCursor();
        
        return $result;
    }

    /**
     * @param array|null $params
     * @return int
     * @throws \Exception
     */
    public function execute(?array $params = null): int
    {
        $this->prepare();

        $params = $params ?: ($this->getParams() ?: null);
        $result = $this->getStatement()->execute($params);

        if ($result === false) {
            [$sqlstate, $code, $message] = $this->getStatement()->errorInfo();
            throw new Exception($message ?: $sqlstate, $code);
        }

        return $this->getStatement()->rowCount();
    }

    /**
     * @return $this
     */
    public function prepare(): self
    {
        if ($this->statement === null) {
            $this->statement = $this->getConnection()
                ->getPdo()
                ->prepare($this->getSql());
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getLastInsertId(): string
    {
        return $this->getConnection()->getPdo()->lastInsertId();
    }

    // -------------------------------------------------------------------------

    /**
     * @return \Zheltikov\Db\Connection
     */
    public function getConnection(): Connection
    {
        return $this->connection;
    }

    /**
     * @return string
     */
    public function getSql(): string
    {
        return $this->sql;
    }

    /**
     * @param string $sql
     * @return $this
     */
    public function setSql(string $sql): self
    {
        $this->sql = $sql;

        return $this;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param string $param
     * @param mixed $value
     * @return $this
     */
    public function setParam(string $param, $value): self
    {
        $this->params[$param] = $value;

        return $this;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function setParams(array $params): self
    {
        foreach ($params as $param => $value) {
            $this->setParam($param, $value);
        }

        return $this;
    }

    /**
     * @return \PDOStatement
     */
    public function getStatement(): PDOStatement
    {
        return $this->statement;
    }
}
