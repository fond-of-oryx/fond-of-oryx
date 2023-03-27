<?php

namespace FondOfOryx\Glue\CompaniesRestApi;

use FondOfOryx\Glue\CompaniesRestApi\Dependency\Client\CompaniesRestApiToCompaniesRestApiPermissionInterface;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Deleter\CompanyDeleter;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Deleter\CompanyDeleterInterface;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\CompanyMapper;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\CompanyMapperInterface;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\PermissionRequestMapper;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\PermissionRequestMapperInterface;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Permission\PermissionChecker;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Permission\PermissionCheckerInterface;
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
            $this->createPermissionChecker()
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
     * @return \FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\PermissionRequestMapperInterface
     */
    public function createPermissionRequestMapper(): PermissionRequestMapperInterface
    {
        return new PermissionRequestMapper();
    }

    /**
     * @return \FondOfOryx\Glue\CompaniesRestApi\Processor\Permission\PermissionCheckerInterface
     */
    public function createPermissionChecker(): PermissionCheckerInterface
    {
        return new PermissionChecker(
            $this->getCompaniesRestApiPermissionClient(),
            $this->createPermissionRequestMapper()
        );
    }

    /**
     * @return \FondOfOryx\Glue\CompaniesRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    public function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder($this->getResourceBuilder());
    }

    /**
     * @return \FondOfOryx\Glue\CompaniesRestApi\Dependency\Client\CompaniesRestApiToCompaniesRestApiPermissionInterface
     * @throws \Spryker\Glue\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getCompaniesRestApiPermissionClient(): CompaniesRestApiToCompaniesRestApiPermissionInterface
    {
        return $this->getProvidedDependency(CompaniesRestApiDependencyProvider::CLIENT_COMPANIES_REST_API_PERMISSION);
    }
}
