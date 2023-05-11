<?php

namespace FondOfOryx\Client\OrderBudgetSearchRestApi;

use FondOfOryx\Client\OrderBudgetSearchRestApi\Dependency\Client\OrderBudgetSearchRestApiToZedRequestClientInterface;
use FondOfOryx\Client\OrderBudgetSearchRestApi\Zed\OrderBudgetSearchRestApiStub;
use FondOfOryx\Client\OrderBudgetSearchRestApi\Zed\OrderBudgetSearchRestApiStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class OrderBudgetSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\OrderBudgetSearchRestApi\Zed\OrderBudgetSearchRestApiStubInterface
     */
    public function createZedOrderBudgetSearchRestApiStub(): OrderBudgetSearchRestApiStubInterface
    {
        return new OrderBudgetSearchRestApiStub(
            $this->getZedRequestClient(),
        );
    }

    /**
     * @return \FondOfOryx\Client\OrderBudgetSearchRestApi\Dependency\Client\OrderBudgetSearchRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): OrderBudgetSearchRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(OrderBudgetSearchRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
