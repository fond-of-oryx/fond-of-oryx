<?php

namespace FondOfOryx\Glue\OneTimePasswordRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class OneTimePasswordRestApiConfig extends AbstractBundleConfig
{
    public const RESOURCE_ONE_TIME_PASSWORD = 'one-time-password';
    public const CONTROLLER_ONE_TIME_PASSWORD = 'one-time-password-resource';

    public const EMAIL_REQUIRED_ERROR_CODE = '1000';
    public const EMAIL_REQUIRED_ERROR_DETAIL = 'The attribute Email is required.';
}
