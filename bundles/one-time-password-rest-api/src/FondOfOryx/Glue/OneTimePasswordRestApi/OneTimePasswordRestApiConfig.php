<?php

namespace FondOfOryx\Glue\OneTimePasswordRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class OneTimePasswordRestApiConfig extends AbstractBundleConfig
{
    /**
     * @var int
     */
    public const SUCCESS_STATUS_CODE = 204;

    /**
     * @var int
     */
    public const ERROR_VALIDATION_STATUS_CODE = 400;

    /**
     * @var string
     */
    public const RESOURCE_ONE_TIME_PASSWORDS = 'one-time-passwords';

    /**
     * @var string
     */
    public const CONTROLLER_ONE_TIME_PASSWORD = 'one-time-password-resource';

    /**
     * @var string
     */
    public const RESOURCE_ONE_TIME_PASSWORD_LOGIN_LINKS = 'one-time-password-login-links';

    /**
     * @var string
     */
    public const CONTROLLER_ONE_TIME_PASSWORD_LOGIN_LINK = 'one-time-password-login-link-resource';

    //The code is not related to a system yet, might change later
    /**
     * @var string
     */
    public const EMAIL_REQUIRED_ERROR_CODE = '1000';

    /**
     * @var string
     */
    public const EMAIL_REQUIRED_ERROR_DETAIL = 'The attribute Email is required.';
}
