<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Business;

use FondOfOryx\Zed\CompaniesRestApi\Business\Deleter\CompanyDeleter;
use FondOfOryx\Zed\CompaniesRestApi\Business\Deleter\CompanyDeleterInterface;
use FondOfOryx\Zed\CompaniesRestApi\CompaniesRestApiDependencyProvider;
use FondOfOryx\Zed\CompaniesRestApi\Dependency\Facade\CompaniesRestApiToCompanyDeleterFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompaniesRestApi\Persistence\CompaniesRestApiRepositoryInterface getRepository()
 */
class CompaniesRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompaniesRestApi\Business\Deleter\CompanyDeleterInterface
     */
    public function createCompanyDeleter(): CompanyDeleterInterface
    {
        return new CompanyDeleter(
            $this->getCompanyDeleterFacade(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompaniesRestApi\Dependency\Facade\CompaniesRestApiToCompanyDeleterFacadeInterface
     */
    protected function getCompanyDeleterFacade(): CompaniesRestApiToCompanyDeleterFacadeInterface
    {
        return $this->getProvidedDependency(CompaniesRestApiDependencyProvider::FACADE_COMPANY_DELETER);
    }
}
