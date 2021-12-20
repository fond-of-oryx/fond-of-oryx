<?php

namespace FondOfOryx\Zed\ApiAuth\Business\Model;

interface AuthInterface
{
    /**
     * @param string $authorizationHeader
     *
     * @return bool
     */
    public function isAuthorized(string $authorizationHeader): bool;
}
