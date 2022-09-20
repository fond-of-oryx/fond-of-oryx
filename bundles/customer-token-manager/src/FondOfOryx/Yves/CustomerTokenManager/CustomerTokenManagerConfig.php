<?php

namespace FondOfOryx\Yves\CustomerTokenManager;

use FondOfOryx\Shared\CustomerTokenManager\CustomerTokenManagerConstants;
use Spryker\Yves\Kernel\AbstractBundleConfig;

class CustomerTokenManagerConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getRedirectUrlAfterLogin(): string
    {
        return $this->get(
            CustomerTokenManagerConstants::REDIRECT_URL_AFTER_LOGIN,
            CustomerTokenManagerConstants::REDIRECT_URL_AFTER_LOGIN_DEFAULT,
        );
    }
}
