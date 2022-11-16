<?php

namespace FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector;

use Codeception\Test\Unit;
use Spryker\Zed\Kernel\Container;

class CustomerRegistrationOneTimePasswordConnectorDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\CustomerRegistrationOneTimePasswordConnectorDependencyProvider
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

        $this->customerRegistrationEmailConnectorDependencyProvider = new CustomerRegistrationOneTimePasswordConnectorDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->assertSame(
            $this->containerMock,
            $this->customerRegistrationEmailConnectorDependencyProvider->provideBusinessLayerDependencies(
                $this->containerMock,
            ),
        );
    }
}
