<?php

namespace Zheltikov\Db;

/**
 *
 */
class Pool
{
    /**
     * @var \Zheltikov\Db\PoolConfig
     */
    protected PoolConfig $config;

    /**
     * @var array<string, \Zheltikov\Db\Connection>
     */
    protected array $connections;

    /**
     * @param \Zheltikov\Db\PoolConfig $config
     */
    public function __construct(PoolConfig $config)
    {
        $this->setConfig($config);
    }

    /**
     * @param string $name
     * @return \Zheltikov\Db\Connection
     */
    public function getConnection(string $name): Connection
    {
        if (!array_key_exists($name, $this->connections)) {
            $this->connections[$name] = new Connection($this->config->get($name));
        }

        return $this->connections[$name];
    }

    /**
     * @return \Zheltikov\Db\PoolConfig
     */
    public function getConfig(): PoolConfig
    {
        return $this->config;
    }

    /**
     * @param \Zheltikov\Db\PoolConfig $config
     * @return $this
     */
    public function setConfig(PoolConfig $config): self
    {
        $this->config = $config;
        $this->connections = [];

        return $this;
    }
}
