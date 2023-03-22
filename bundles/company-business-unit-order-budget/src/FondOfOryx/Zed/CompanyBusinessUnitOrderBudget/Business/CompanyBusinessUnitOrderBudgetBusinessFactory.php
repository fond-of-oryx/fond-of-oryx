<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business;

use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander\CompanyBusinessUnitExpander;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander\CompanyBusinessUnitExpanderInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander\QuoteExpander;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander\QuoteExpanderInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Reader\OrderBudgetReader;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Reader\OrderBudgetReaderInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Reducer\OrderBudgetReducer;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Reducer\OrderBudgetReducerInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Validator\QuoteValidator;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Validator\QuoteValidatorInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Writer\OrderBudgetWriter;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Writer\OrderBudgetWriterInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\CompanyBusinessUnitOrderBudgetDependencyProvider;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetRepositoryInterface getRepository()
 */
class CompanyBusinessUnitOrderBudgetBusinessFactory extends AbstractBusinessFactory
{
    use LoggerTrait;

    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Reducer\OrderBudgetReducerInterface
     */
    public function createOrderBudgetReducer(): OrderBudgetReducerInterface
    {
        return new OrderBudgetReducer(
            $this->getOrderBudgetFacade(),
            $this->getPermissionFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Validator\QuoteValidatorInterface
     */
    public function createQuoteValidator(): QuoteValidatorInterface
    {
        return new QuoteValidator(
            $this->getPermissionFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander\QuoteExpanderInterface
     */
    public function createQuoteExpander(): QuoteExpanderInterface
    {
        return new QuoteExpander(
            $this->createQuoteValidator(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Writer\OrderBudgetWriterInterface
     */
    public function createOrderBudgetWriter(): OrderBudgetWriterInterface
    {
        return new OrderBudgetWriter(
            $this->createOrderBudgetReader(),
            $this->getOrderBudgetFacade(),
            $this->getEntityManager(),
            $this->getRepository(),
            $this->getLogger(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Reader\OrderBudgetReaderInterface
     */
    protected function createOrderBudgetReader(): OrderBudgetReaderInterface
    {
        return new OrderBudgetReader(
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander\CompanyBusinessUnitExpanderInterface
     */
    public function createCompanyBusinessUnitExpander(): CompanyBusinessUnitExpanderInterface
    {
        return new CompanyBusinessUnitExpander(
            $this->getOrderBudgetFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface
     */
    protected function getOrderBudgetFacade(): CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface
    {
        return $this->getProvidedDependency(
            CompanyBusinessUnitOrderBudgetDependencyProvider::FACADE_ORDER_BUDGET,
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface
     */
    protected function getPermissionFacade(): CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface
    {
        return $this->getProvidedDependency(
            CompanyBusinessUnitOrderBudgetDependencyProvider::FACADE_PERMISSION,
        );
    }
}
