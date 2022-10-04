<?php

namespace FondOfOryx\Yves\CustomerTokenManager;

use FondOfOryx\Shared\CustomerTokenManager\CustomerTokenManagerConstants;
use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Yves\Kernel\AbstractBundleConfig;

class CustomerTokenManagerConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getRedirectPathAfterLogin(): string
    {
        return $this->get(
            CustomerTokenManagerConstants::REDIRECT_PATH_AFTER_LOGIN,
            CustomerTokenManagerConstants::REDIRECT_PATH_AFTER_LOGIN_DEFAULT,
        );
    }

    /**
     * @return string
     */
    public function getYvesBaseUrl(): string
    {
        return $this->get(
            ApplicationConstants::BASE_URL_YVES,
            '',
        );
    }

    /**
     * @return string
     */
    public function getSignatureParameterName(): string
    {
        return $this->get(
            CustomerTokenManagerConstants::SIGNATURE_PARAMETER,
            'signature',
        );
    }

    /**
     * @return string
     */
    public function getAnonymousPattern(): string
    {
        return $this->get(
            CustomerTokenManagerConstants::CUSTOMER_ANONYMOUS_PATTERN,
            CustomerTokenManagerConstants::CUSTOMER_ANONYMOUS_PATTERN_DEFAULT,
        );
    }
}
