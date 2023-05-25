<?php

namespace FondOfOryx\Zed\ApiAuth\Business;

use FondOfOryx\Zed\ApiAuth\Business\Model\AuthInterface;
use FondOfOryx\Zed\ApiAuth\Business\Model\BasicAuth;
use FondOfOryx\Zed\ApiAuth\Business\Model\BasicToken;
use FondOfOryx\Zed\ApiAuth\Business\Model\TokenInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ApiAuth\ApiAuthConfig getConfig()
 */
class ApiAuthBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ApiAuth\Business\Model\AuthInterface
     */
    public function createAuthModel(): AuthInterface
    {
        return new BasicAuth($this->createTokenModel());
    }

    /**
     * @return \FondOfOryx\Zed\ApiAuth\Business\Model\TokenInterface
     */
    public function createTokenModel(): TokenInterface
    {
        return new BasicToken($this->getConfig()->getRawToken());
    }
}
