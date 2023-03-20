<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Business;

use FondOfOryx\Zed\CompaniesRestApi\Business\Deleter\CompanyDeleter;
use FondOfOryx\Zed\CompaniesRestApi\Business\Deleter\CompanyDeleterInterface;
use FondOfOryx\Zed\CompaniesRestApi\CompaniesRestApiDependencyProvider;
use FondOfOryx\Zed\CompaniesRestApi\Dependency\Facade\CompaniesRestApiToCompanyDeleterFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class CompaniesRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompaniesRestApi\Business\Deleter\CompanyDeleterInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createCompanyDeleter(): CompanyDeleterInterface
    {
        return new CompanyDeleter(
            $this->getCompanyDeleterFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompaniesRestApi\Dependency\Facade\CompaniesRestApiToCompanyDeleterFacadeInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getCompanyDeleterFacade(): CompaniesRestApiToCompanyDeleterFacadeInterface
    {
        return $this->getProvidedDependency(CompaniesRestApiDependencyProvider::FACADE_COMPANY_DELETER);
    }
}
