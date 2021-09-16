<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business;

use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander\QuoteExpander;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander\QuoteExpanderInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Validator\QuoteValidator;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Validator\QuoteValidatorInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Writer\OrderBudgetWriter;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Writer\OrderBudgetWriterInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\CompanyBusinessUnitOrderBudgetDependencyProvider;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetEntityManagerInterface getEntityManager()
 */
class CompanyBusinessUnitOrderBudgetBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Validator\QuoteValidatorInterface
     */
    public function createQuoteValidator(): QuoteValidatorInterface
    {
        return new QuoteValidator(
            $this->getPermissionFacade()
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander\QuoteExpanderInterface
     */
    public function createQuoteExpander(): QuoteExpanderInterface
    {
        return new QuoteExpander(
            $this->createQuoteValidator()
        );
    }

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

    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface
     */
    protected function getPermissionFacade(): CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface
    {
        return $this->getProvidedDependency(
            CompanyBusinessUnitOrderBudgetDependencyProvider::FACADE_PERMISSION
        );
    }
}
