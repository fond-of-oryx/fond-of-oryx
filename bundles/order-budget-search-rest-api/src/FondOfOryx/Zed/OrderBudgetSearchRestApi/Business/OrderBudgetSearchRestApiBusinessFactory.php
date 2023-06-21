<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi\Business;

use FondOfOryx\Zed\OrderBudgetSearchRestApi\Business\Reader\OrderBudgetReader;
use FondOfOryx\Zed\OrderBudgetSearchRestApi\Business\Reader\OrderBudgetReaderInterface;
use FondOfOryx\Zed\OrderBudgetSearchRestApi\Dependency\Facade\OrderBudgetSearchRestApiToOrderBudgetFacadeInterface;
use FondOfOryx\Zed\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\OrderBudgetSearchRestApiRepositoryInterface getRepository()
 */
class OrderBudgetSearchRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\OrderBudgetSearchRestApi\Business\Reader\OrderBudgetReaderInterface
     */
    public function createOrderBudgetReader(): OrderBudgetReaderInterface
    {
        return new OrderBudgetReader(
            $this->getRepository(),
            $this->getOrderBudgetFacade(),
            $this->getSearchOrderBudgetQueryExpanderPlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\OrderBudgetSearchRestApi\Dependency\Facade\OrderBudgetSearchRestApiToOrderBudgetFacadeInterface
     */
    protected function getOrderBudgetFacade(): OrderBudgetSearchRestApiToOrderBudgetFacadeInterface
    {
        return $this->getProvidedDependency(OrderBudgetSearchRestApiDependencyProvider::FACADE_ORDER_BUDGET);
    }

    /**
     * @return array<\FondOfOryx\Zed\OrderBudgetSearchRestApiExtension\Dependency\Plugin\SearchOrderBudgetQueryExpanderPluginInterface>
     */
    protected function getSearchOrderBudgetQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(
            OrderBudgetSearchRestApiDependencyProvider::PLUGINS_SEARCH_ORDER_BUDGET_QUERY_EXPANDER,
        );
    }
}
