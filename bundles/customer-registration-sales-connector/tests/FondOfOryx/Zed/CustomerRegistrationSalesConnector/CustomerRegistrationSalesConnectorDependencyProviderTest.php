<?php

namespace FondOfOryx\Zed\CustomerRegistrationSalesConnector;

use Codeception\Test\Unit;
use Spryker\Zed\Kernel\Container;

class CustomerRegistrationSalesConnectorDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationSalesConnector\CustomerRegistrationSalesConnectorDependencyProvider
     */
    protected $customerRegistrationSalesConnectorDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationSalesConnectorDependencyProvider = new CustomerRegistrationSalesConnectorDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->assertSame(
            $this->containerMock,
            $this->customerRegistrationSalesConnectorDependencyProvider->provideBusinessLayerDependencies(
                $this->containerMock,
            ),
        );
    }
}
