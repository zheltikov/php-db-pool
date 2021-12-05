<?php

namespace Zheltikov\Db;

/**
 *
 */
class PoolConfig
{
    /**
     * @var array<string, mixed>
     */
    protected array $configs;

    /**
     * @param array<string, mixed> $configs
     */
    public function __construct(array $configs = [])
    {
        $this->setConfigs($configs);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function get(string $name)
    {
        if (!$this->has($name)) {
            // throw
        }

        return $this->configs[$name];
    }

    /**
     * @param array<string, mixed> $configs
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
     * @param mixed $config
     * @return $this
     */
    public function set(string $name, $config): self
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

