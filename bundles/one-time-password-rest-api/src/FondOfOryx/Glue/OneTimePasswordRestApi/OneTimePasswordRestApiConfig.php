<?php

namespace FondOfOryx\Glue\OneTimePasswordRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class OneTimePasswordRestApiConfig extends AbstractBundleConfig
{
    public const SUCCESS_STATUS_CODE = 204;
    public const ERROR_VALIDATION_STATUS_CODE = 400;

    public const RESOURCE_ONE_TIME_PASSWORDS = 'one-time-passwords';
    public const CONTROLLER_ONE_TIME_PASSWORD = 'one-time-password-resource';

    public const RESOURCE_ONE_TIME_PASSWORD_LOGIN_LINKS = 'one-time-password-login-links';
    public const CONTROLLER_ONE_TIME_PASSWORD_LOGIN_LINK = 'one-time-password-login-link-resource';

    //The code is not related to a system yet, might change later
    public const EMAIL_REQUIRED_ERROR_CODE = '1000';
    public const EMAIL_REQUIRED_ERROR_DETAIL = 'The attribute Email is required.';
}
