<?php

namespace FondOfOryx\Zed\ApiAuth\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ApiAuth\Business\ApiAuthBusinessFactory getFactory()
 */
class ApiAuthFacade extends AbstractFacade implements ApiAuthFacadeInterface
{
    /**
     * @param string $authorizationHeader
     *
     * @return bool
     */
    public function isAuthenticated(string $authorizationHeader): bool
    {
        return $this->getFactory()
            ->createAuthModel()
            ->isAuthorized($authorizationHeader);
    }
}
