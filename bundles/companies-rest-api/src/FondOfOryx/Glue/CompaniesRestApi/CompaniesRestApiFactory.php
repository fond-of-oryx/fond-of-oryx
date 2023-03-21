<?php

namespace FondOfOryx\Glue\CompaniesRestApi;

use FondOfOryx\Glue\CompaniesRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Deleter\CompanyDeleter;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Deleter\CompanyDeleterInterface;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\CompanyMapper;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\CompanyMapperInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\CompaniesRestApi\CompaniesRestApiClient getClient()
 * @method \FondOfOryx\Glue\CompaniesRestApi\CompaniesRestApiConfig getConfig()
 */
class CompaniesRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\CompaniesRestApi\Processor\Deleter\CompanyDeleterInterface
     */
    public function createCompanyDeleter(): CompanyDeleterInterface
    {
        return new CompanyDeleter(
            $this->getClient(),
            $this->createCompanyMapper(),
            $this->createRestResponseBuilder(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\CompanyMapperInterface
     */
    public function createCompanyMapper(): CompanyMapperInterface
    {
        return new CompanyMapper();
    }

    /**
     * @return \FondOfOryx\Glue\CompaniesRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    public function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder($this->getResourceBuilder());
    }
}
