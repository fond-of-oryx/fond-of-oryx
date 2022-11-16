<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector;

use Codeception\Test\Unit;
use Spryker\Zed\Kernel\Container;

class CustomerRegistrationEmailConnectorDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationEmailConnector\CustomerRegistrationEmailConnectorDependencyProvider
     */
    protected $customerRegistrationEmailConnectorDependencyProvider;

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

        $this->customerRegistrationEmailConnectorDependencyProvider = new CustomerRegistrationEmailConnectorDependencyProvider();
    }

    /**
     * @return void
     */
    public function testAddMailFacade(): void
    {
        $this->assertSame(
            $this->containerMock,
            $this->customerRegistrationEmailConnectorDependencyProvider->provideBusinessLayerDependencies(
                $this->containerMock,
            ),
        );
    }
}
