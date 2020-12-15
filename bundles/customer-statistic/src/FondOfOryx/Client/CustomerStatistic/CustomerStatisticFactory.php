<?php

namespace FondOfOryx\Client\CustomerStatistic;

use FondOfOryx\Client\CustomerStatistic\Dependency\Client\CustomerStatisticToZedRequestClientInterface;
use FondOfOryx\Client\CustomerStatistic\Zed\CustomerStatisticZedStub;
use FondOfOryx\Client\CustomerStatistic\Zed\CustomerStatisticZedStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class CustomerStatisticFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\CustomerStatistic\Dependency\Client\CustomerStatisticToZedRequestClientInterface
     */
    protected function getZedRequestClient(): CustomerStatisticToZedRequestClientInterface
    {
        return $this->getProvidedDependency(CustomerStatisticDependencyProvider::CLIENT_ZED_REQUEST);
    }

    /**
     * @return \FondOfOryx\Client\CustomerStatistic\Zed\CustomerStatisticZedStubInterface
     */
    public function createCustomerStatisticZedStub(): CustomerStatisticZedStubInterface
    {
        return new CustomerStatisticZedStub(
            $this->getZedRequestClient()
        );
    }
}
