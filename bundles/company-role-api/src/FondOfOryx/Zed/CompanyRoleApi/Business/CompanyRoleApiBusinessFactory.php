<?php

namespace FondOfOryx\Zed\CompanyRoleApi\Business;

use FondOfOryx\Zed\CompanyRoleApi\Business\Model\CompanyRoleApi;
use FondOfOryx\Zed\CompanyRoleApi\Business\Model\CompanyRoleApiInterface;
use FondOfOryx\Zed\CompanyRoleApi\CompanyRoleApiDependencyProvider;
use FondOfOryx\Zed\CompanyRoleApi\Dependency\Facade\CompanyRoleApiToCompanyRoleFacadeInterface;
use FondOfOryx\Zed\CompanyRoleApi\Dependency\QueryContainer\CompanyRoleApiToApiQueryContainerInterface;
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
            $this->getApiQueryContainer(),
            $this->getCompanyRoleFacade(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyRoleApi\Dependency\QueryContainer\CompanyRoleApiToApiQueryContainerInterface
     */
    protected function getApiQueryContainer(): CompanyRoleApiToApiQueryContainerInterface
    {
        return $this->getProvidedDependency(CompanyRoleApiDependencyProvider::QUERY_CONTAINER_API);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyRoleApi\Dependency\Facade\CompanyRoleApiToCompanyRoleFacadeInterface
     */
    protected function getCompanyRoleFacade(): CompanyRoleApiToCompanyRoleFacadeInterface
    {
        return $this->getProvidedDependency(CompanyRoleApiDependencyProvider::FACADE_COMPANY_ROLE);
    }
}
