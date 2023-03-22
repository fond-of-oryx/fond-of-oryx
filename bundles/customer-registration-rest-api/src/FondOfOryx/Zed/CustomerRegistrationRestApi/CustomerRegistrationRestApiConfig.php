<?php

namespace FondOfOryx\Zed\CustomerRegistrationRestApi;

use FondOfOryx\Shared\CustomerRegistrationRestApi\CustomerRegistrationRestApiConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class CustomerRegistrationRestApiConfig extends AbstractBundleConfig
{
    /**
     * @uses CustomerConstants::CUSTOMER_REGISTRATION_WITH_CONFIRMATION_MAIL_TYPE
     *
     * @var string
     */
    public const CUSTOMER_REGISTRATION_WITH_CONFIRMATION_MAIL_TYPE = 'customer registration confirmation mail';

    /**
     * Specification:
     * - Provides a registration confirmation token url.
     *
     * @api
     *
     * @param string $token
     *
     * @return string
     */
    public function getRegisterConfirmTokenUrl(string $token): string
    {
        $fallback = $this->getHostYves() . '/register/confirm?token=%s';

        return sprintf($this->get(CustomerRegistrationRestApiConstants::REGISTRATION_CONFIRMATION_TOKEN_URL, $fallback), $token);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getHostYves(): string
    {
        return $this->get(CustomerRegistrationRestApiConstants::BASE_URL_YVES);
    }
}
