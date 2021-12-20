<?php

namespace FondOfOryx\Zed\ApiAuth\Business\Model;

class BasicToken implements TokenInterface
{
    /**
     * @var string
     */
    protected $rawToken;

    /**
     * @param string $rawToken
     */
    public function __construct(string $rawToken)
    {
        $this->rawToken = $rawToken;
    }

    /**
     * @param string $rawToken
     *
     * @return void
     */
    public function setRawToken(string $rawToken): void
    {
        $this->rawToken = $rawToken;
    }

    /**
     * @return string
     */
    public function getRawToken(): string
    {
        return $this->rawToken;
    }

    /**
     * @param string $rawToken
     *
     * @return bool
     */
    public function check(string $rawToken): bool
    {
        return $this->rawToken === $rawToken;
    }
}
