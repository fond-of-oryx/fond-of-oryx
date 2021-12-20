<?php

namespace FondOfOryx\Zed\ApiAuth\Business\Model;

class BasicAuth implements AuthInterface
{
    /**
     * @var string
     */
    protected const AUTH_TYPE = 'Basic';

    /**
     * @var \FondOfOryx\Zed\ApiAuth\Business\Model\TokenInterface
     */
    protected $token;

    /**
     * @param \FondOfOryx\Zed\ApiAuth\Business\Model\TokenInterface $token
     */
    public function __construct(TokenInterface $token)
    {
        $this->token = $token;
    }

    /**
     * @param string $authorizationHeader
     *
     * @return bool
     */
    public function isAuthorized(string $authorizationHeader): bool
    {
        $rawToken = $this->extractToken($authorizationHeader);

        return $this->token->check($rawToken);
    }

    /**
     * @param string $authorizationHeader
     *
     * @return string
     */
    protected function extractToken(string $authorizationHeader): string
    {
        $position = strpos($authorizationHeader, static::AUTH_TYPE);

        if ($position === false) {
            return $authorizationHeader;
        }

        return substr($authorizationHeader, $position + strlen(static::AUTH_TYPE) + 1);
    }
}
