<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class RepresentativeCompanyUserRestApiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const RESOURCE_REPRESENTATIVE_COMPANY_USER_REST_API = 'representative-company-user';

    /**
     * @var string
     */
    public const CONTROLLER_RESOURCE_REPRESENTATIVE_COMPANY_USER_REST_API = 'representative-company-user-resource';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_USER_IS_NOT_ALLOWED_TO_ADD_REPRESENTATION = 'Missing permission to representation!';

    /**
     * @var int
     */
    public const RESPONSE_CODE_USER_IS_NOT_ALLOWED_TO_ADD_REPRESENTATION = 0;
}
