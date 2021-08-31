<?php

namespace FondOfOryx\Zed\OrderBudget\Business;

use FondOfOryx\Zed\OrderBudget\Business\Mapper\OrderBudgetHistoryMapper;
use FondOfOryx\Zed\OrderBudget\Business\Mapper\OrderBudgetHistoryMapperInterface;
use FondOfOryx\Zed\OrderBudget\Business\Reader\OrderBudgetReader;
use FondOfOryx\Zed\OrderBudget\Business\Reader\OrderBudgetReaderInterface;
use FondOfOryx\Zed\OrderBudget\Business\Resetter\OrderBudgetResetter;
use FondOfOryx\Zed\OrderBudget\Business\Resetter\OrderBudgetResetterInterface;
use FondOfOryx\Zed\OrderBudget\Dependency\Service\OrderBudgetToUtilDateTimeServiceInterface;
use FondOfOryx\Zed\OrderBudget\OrderBudgetDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\OrderBudget\OrderBudgetConfig getConfig()
 * @method \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetRepositoryInterface getRepository()
 */
class OrderBudgetBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\OrderBudget\Business\Resetter\OrderBudgetResetterInterface
     */
    public function createOrderBudgetResetter(): OrderBudgetResetterInterface
    {
        return new OrderBudgetResetter(
            $this->createOrderBudgetReader(),
            $this->createOrderBudgetHistoryMapper(),
            $this->getUtilDateTimeService(),
            $this->getEntityManager(),
            $this->getConfig()
        );
    }

    /**
     * @return \FondOfOryx\Zed\OrderBudget\Business\Reader\OrderBudgetReaderInterface
     */
    protected function createOrderBudgetReader(): OrderBudgetReaderInterface
    {
        return new OrderBudgetReader(
            $this->getRepository()
        );
    }

    /**
     * @return \FondOfOryx\Zed\OrderBudget\Business\Mapper\OrderBudgetHistoryMapperInterface
     */
    protected function createOrderBudgetHistoryMapper(): OrderBudgetHistoryMapperInterface
    {
        return new OrderBudgetHistoryMapper();
    }

    /**
     * @return \FondOfOryx\Zed\OrderBudget\Dependency\Service\OrderBudgetToUtilDateTimeServiceInterface
     */
    protected function getUtilDateTimeService(): OrderBudgetToUtilDateTimeServiceInterface
    {
        return $this->getProvidedDependency(OrderBudgetDependencyProvider::SERVICE_UTIL_DATETIME);
    }
}
