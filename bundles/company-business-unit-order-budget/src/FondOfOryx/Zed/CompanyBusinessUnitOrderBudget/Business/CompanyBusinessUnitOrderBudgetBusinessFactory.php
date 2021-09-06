<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business;

use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Writer\OrderBudgetWriter;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Writer\OrderBudgetWriterInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\CompanyBusinessUnitOrderBudgetDependencyProvider;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetEntityManagerInterface getEntityManager()
 */
class CompanyBusinessUnitOrderBudgetBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Writer\OrderBudgetWriterInterface
     */
    public function createOrderBudgetWriter(): OrderBudgetWriterInterface
    {
        return new OrderBudgetWriter(
            $this->getOrderBudgetFacade(),
            $this->getEntityManager()
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface
     */
    protected function getOrderBudgetFacade(): CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface
    {
        return $this->getProvidedDependency(
            CompanyBusinessUnitOrderBudgetDependencyProvider::FACADE_ORDER_BUDGET
        );
    }
}
