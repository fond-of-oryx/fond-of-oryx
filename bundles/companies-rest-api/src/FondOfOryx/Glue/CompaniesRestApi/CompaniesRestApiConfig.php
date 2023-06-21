<?php

namespace FondOfOryx\Glue\CompaniesRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class CompaniesRestApiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const RESOURCE_COMPANIES_REST_API = 'companies';

    /**
     * @var string
     */
    public const CONTROLLER_RESOURCE_COMPANIES_REST_API = 'companies-resource';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_USER_IS_NOT_ALLOWED_TO_DELETE_COMPANY = 'Missing permission to delete company!';

    /**
     * @var int
     */
    public const RESPONSE_CODE_USER_IS_NOT_ALLOWED_TO_DELETE_COMPANY = 0;
}
