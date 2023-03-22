<?php

namespace FondOfOryx\Zed\CompanyRoleApi\Business;

use FondOfOryx\Zed\CompanyRoleApi\Business\Model\CompanyRoleApi;
use FondOfOryx\Zed\CompanyRoleApi\Business\Model\CompanyRoleApiInterface;
use FondOfOryx\Zed\CompanyRoleApi\CompanyRoleApiDependencyProvider;
use FondOfOryx\Zed\CompanyRoleApi\Dependency\Facade\CompanyRoleApiToApiFacadeInterface;
use FondOfOryx\Zed\CompanyRoleApi\Dependency\Facade\CompanyRoleApiToCompanyRoleFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyRoleApi\CompanyRoleApiConfig getConfig()
 * @method \FondOfOryx\Zed\CompanyRoleApi\Persistence\CompanyRoleApiQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\CompanyRoleApi\Persistence\CompanyRoleApiRepositoryInterface getRepository()
 */
class CompanyRoleApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyRoleApi\Business\Model\CompanyRoleApiInterface
     */
    public function createCompanyRoleApi(): CompanyRoleApiInterface
    {
        return new CompanyRoleApi(
            $this->getApiFacade(),
            $this->getCompanyRoleFacade(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyRoleApi\Dependency\Facade\CompanyRoleApiToApiFacadeInterface
     */
    protected function getApiFacade(): CompanyRoleApiToApiFacadeInterface
    {
        return $this->getProvidedDependency(CompanyRoleApiDependencyProvider::FACADE_API);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyRoleApi\Dependency\Facade\CompanyRoleApiToCompanyRoleFacadeInterface
     */
    protected function getCompanyRoleFacade(): CompanyRoleApiToCompanyRoleFacadeInterface
    {
        return $this->getProvidedDependency(CompanyRoleApiDependencyProvider::FACADE_COMPANY_ROLE);
    }
}
