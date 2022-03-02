<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Business;

use FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Business\Expander\JellyfishOrderExpander;
use FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Business\Expander\JellyfishOrderExpanderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Dependency\Facade\JellyfishSalesOrderCompanyBusinessUnitToCompanyUserReferenceFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\JellyfishSalesOrderCompanyBusinessUnitDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class JellyfishSalesOrderCompanyBusinessUnitBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Business\Expander\JellyfishOrderExpanderInterface
     */
    public function createJellyfishOrderExpander(): JellyfishOrderExpanderInterface
    {
        return new JellyfishOrderExpander(
            $this->getCompanyUserReferenceFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Dependency\Facade\JellyfishSalesOrderCompanyBusinessUnitToCompanyUserReferenceFacadeInterface
     */
    protected function getCompanyUserReferenceFacade(): JellyfishSalesOrderCompanyBusinessUnitToCompanyUserReferenceFacadeInterface
    {
        return $this->getProvidedDependency(
            JellyfishSalesOrderCompanyBusinessUnitDependencyProvider::FACADE_COMPANY_USER_REFERENCE,
        );
    }
}
