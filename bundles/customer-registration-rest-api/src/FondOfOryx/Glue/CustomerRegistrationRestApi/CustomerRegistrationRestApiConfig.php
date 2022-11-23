<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class CustomerRegistrationRestApiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const RESOURCE_CUSTOMER_REGISTRATION = 'customer-registration';

    /**
     * @var string
     */
    public const CONTROLLER_CUSTOMER_REGISTRATION = 'customer-registration-resource';

    /**
     * @var string
     */
    public const EMAIL_REQUIRED_ERROR_CODE = '1';

    /**
     * @var string
     */
    public const EMAIL_REQUIRED_ERROR_DETAIL = 'Missing customer e-mail address to start registration process!';
}
