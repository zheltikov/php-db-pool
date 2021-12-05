<?php

namespace Zheltikov\Db;

use PDO;
use RuntimeException;

/**
 *
 */
class Connection
{
    /**
     * @var \Zheltikov\Db\Config
     */
    protected Config $config;

    /**
     * @var \PDO|null
     */
    protected ?PDO $pdo = null;

    /**
     * @var \Zheltikov\Db\QueryInterface|null
     */
    protected ?QueryInterface $query = null;

    // -------------------------------------------------------------------------

    /**
     * @param \Zheltikov\Db\Config $config
     */
    public function __construct(Config $config)
    {
        $this->setConfig($config);
    }

    /**
     * @return bool
     */
    public function open(): bool
    {
        if ($this->pdo !== null) {
            if ($this->getConfig()->getDsn() === '') {
                throw new RuntimeException('DSN is required!');
            }

            $this->pdo = new PDO(
                $this->getConfig()->getDsn(),
                $this->getConfig()->getUsername(),
                $this->getConfig()->getPassword(),
                $this->getAttributes()
            );
        }

        return true;
    }

    /**
     * @return bool
     */
    public function close(): bool
    {
        $this->pdo = null;
        $this->query = null;

        return true;
    }

    // -------------------------------------------------------------------------

    /**
     * @return \PDO
     */
    public function getPdo(): PDO
    {
        if (
            $this->pdo === null
            && $this->open() === false
        ) {
            throw new RuntimeException('Could not open connection!');
        }

        return $this->pdo;
    }

    /**
     * @return \Zheltikov\Db\Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * @param bool $reset
     * @return \Zheltikov\Db\QueryInterface
     */
    public function getQuery(bool $reset = true): QueryInterface
    {
        if ($this->query === null) {
            if ($this->open() === false) {
                throw new RuntimeException('Could not open connection!');
            }

            $this->query = QueryFactory::get($this);
        }

        if ($reset) {
            return $this->query->reset();
        }

        return $this->query;
    }

    /**
     * @return string
     */
    public function getScheme(): string
    {
        return $this->getConfig()->getScheme();
    }

    /**
     * @param \Zheltikov\Db\Config $config
     * @return $this
     */
    public function setConfig(Config $config): self
    {
        if ($this->close() === false) {
            throw new RuntimeException('Could not close connection!');
        }

        $this->config = $config;

        return $this;
    }

    /**
     * @param int $attribute
     * @param mixed $value
     * @return $this
     */
    public function setAttribute(int $attribute, $value): self
    {
        if ($this->pdo !== null) {
            $this->getPdo()->setAttribute($attribute, $value);
        } else {
            $this->getConfig()->setOption($attribute, $value);
        }

        return $this;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function setAttributes(array $attributes): self
    {
        foreach ($attributes as $attribute => $value) {
            $this->setAttribute($attribute, $value);
        }

        return $this;
    }

    /**
     * @param int $attribute
     * @return mixed
     */
    public function getAttribute(int $attribute)
    {
        return $this->getPdo()->getAttribute($attribute);
    }

    /**
     * @return array|null
     */
    public function getAttributes(): ?array
    {
        return $this->getConfig()->getOptions();
    }
}

