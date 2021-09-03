<?php

namespace FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Business;

use FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Business\Writer\OrderBudgetWriter;
use FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Business\Writer\OrderBudgetWriterInterface;
use FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Dependency\Facade\OrderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeInterface;
use FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\OrderBudgetCompanyBusinessUnitConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Persistence\OrderBudgetCompanyBusinessUnitConnectorEntityManagerInterface getEntityManager()
 */
class OrderBudgetCompanyBusinessUnitConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Business\Writer\OrderBudgetWriterInterface
     */
    public function createOrderBudgetWriter(): OrderBudgetWriterInterface
    {
        return new OrderBudgetWriter(
            $this->getOrderBudgetFacade(),
            $this->getEntityManager()
        );
    }

    /**
     * @return \FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Dependency\Facade\OrderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeInterface
     */
    protected function getOrderBudgetFacade(): OrderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeInterface
    {
        return $this->getProvidedDependency(
            OrderBudgetCompanyBusinessUnitConnectorDependencyProvider::FACADE_ORDER_BUDGET
        );
    }
}
