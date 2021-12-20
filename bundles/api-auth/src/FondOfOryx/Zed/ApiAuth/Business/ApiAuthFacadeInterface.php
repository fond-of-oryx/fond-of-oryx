<?php

namespace FondOfOryx\Zed\ApiAuth\Business;

interface ApiAuthFacadeInterface
{
    /**
     * @param string $authorizationHeader
     *
     * @return bool
     */
    public function isAuthenticated(string $authorizationHeader): bool;
}
