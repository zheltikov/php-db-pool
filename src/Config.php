<?php

namespace Zheltikov\Db;

/**
 *
 */
class Config
{
    /**
     * @var string
     */
    protected string $dsn;

    /**
     * @var string
     */
    protected string $scheme;

    /**
     * @var string|null
     */
    protected ?string $username = null;

    /**
     * @var string|null
     */
    protected ?string $password = null;

    /**
     * @var array|null
     */
    protected ?array $options = null;

    // -------------------------------------------------------------------------

    /**
     * @param string $dsn
     * @param string $scheme
     * @param string|null $username
     * @param string|null $password
     * @param array|null $options
     */
    public function __construct(
        string $dsn,
        string $scheme,
        ?string $username = null,
        ?string $password = null,
        ?array $options = null
    ) {
        $this->dsn = $dsn;
        $this->scheme = $scheme;
        $this->username = $username;
        $this->password = $password;
        $this->options = $options;
    }

    // -------------------------------------------------------------------------

    /**
     * @return string
     */
    public function getDsn(): string
    {
        return $this->dsn;
    }

    /**
     * @param string $dsn
     * @return $this
     */
    public function setDsn(string $dsn): self
    {
        $this->dsn = $dsn;
        return $this;
    }

    /**
     * @return string
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * @param string $scheme
     * @return $this
     */
    public function setScheme(string $scheme): self
    {
        $this->scheme = $scheme;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     * @return $this
     */
    public function setUsername(?string $username): self
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     * @return $this
     */
    public function setPassword(?string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getOptions(): ?array
    {
        return $this->options;
    }

    /**
     * @param array|null $options
     * @return $this
     */
    public function setOptions(?array $options): self
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @param array-key $key
     * @param mixed $value
     * @return $this
     */
    public function setOption($key, $value): self
    {
        if ($this->getOptions() === null) {
            return $this->setOptions([$key => $value]);
        }

        $this->options[$key] = $value;

        return $this;
    }
}
