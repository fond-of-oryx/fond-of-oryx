<?php

namespace FondOfOryx\Glue\CompaniesRestApi;

use FondOfOryx\Glue\CompaniesRestApi\Processor\Deleter\CompanyDeleter;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Deleter\CompanyDeleterInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\CompaniesRestApi\CompaniesRestApiClient getClient()
 * @method \FondOfOryx\Glue\CompaniesRestApi\CompaniesRestApiConfig getConfig()
 */
class CompaniesRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Zed\CompaniesRestApi\Business\Deleter\CompanyDeleterInterface
     */
    public function createCompanyDeleter(): CompanyDeleterInterface
    {
        return new CompanyDeleter();
    }
}
