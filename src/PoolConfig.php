<?php

namespace Zheltikov\Db;

use RuntimeException;

/**
 *
 */
class PoolConfig
{
    /**
     * @var array<string, \Zheltikov\Db\Config>
     */
    protected array $configs;

    /**
     * @param array<string, \Zheltikov\Db\Config> $configs
     */
    public function __construct(array $configs = [])
    {
        $this->setConfigs($configs);
    }

    /**
     * @param string $name
     * @return \Zheltikov\Db\Config
     */
    public function get(string $name): Config
    {
        if (!$this->has($name)) {
            throw new RuntimeException('Config not found!');
        }

        return $this->configs[$name];
    }

    /**
     * @param array<string, \Zheltikov\Db\Config> $configs
     * @return $this
     */
    public function setConfigs(array $configs = []): self
    {
        $this->configs = [];

        foreach ($configs as $name => $config) {
            $this->set($name, $config);
        }

        return $this;
    }

    /**
     * @param string $name
     * @param \Zheltikov\Db\Config $config
     * @return $this
     */
    public function set(string $name, Config $config): self
    {
        $this->configs[$name] = $config;

        return $this;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return array_key_exists($name, $this->configs);
    }
}
