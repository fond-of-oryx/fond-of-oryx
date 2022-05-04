<?php

namespace FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business;

use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Writer\CompanyUserCompanyRoleWriter;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Writer\CompanyUserCompanyRoleWriterInterface;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\CompanyUserCompanyRoleConnectorDependencyProvider;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Dependency\Facade\CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class CompanyUserCompanyRoleConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Writer\CompanyUserCompanyRoleWriterInterface
     */
    public function createCompanyUserCompanyRoleWriter(): CompanyUserCompanyRoleWriterInterface
    {
        return new CompanyUserCompanyRoleWriter(
            $this->getCompanyRoleFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Dependency\Facade\CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface
     */
    protected function getCompanyRoleFacade(): CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface
    {
        return $this->getProvidedDependency(CompanyUserCompanyRoleConnectorDependencyProvider::FACADE_COMPANY_ROLE);
    }
}
