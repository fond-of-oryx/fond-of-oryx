<?php

namespace FondOfOryx\Zed\CustomerRegistration;

use Codeception\Test\Unit;
use Spryker\Zed\Kernel\Container;

class CustomerRegistrationDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationDependencyProvider
     */
    protected $customerRegistrationDependencyProvider;

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

        $this->customerRegistrationDependencyProvider = new CustomerRegistrationDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->assertSame(
            $this->containerMock,
            $this->customerRegistrationDependencyProvider->provideBusinessLayerDependencies(
                $this->containerMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testProvideCommunicationLayerDependencies(): void
    {
        $this->assertSame(
            $this->containerMock,
            $this->customerRegistrationDependencyProvider->provideCommunicationLayerDependencies(
                $this->containerMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testProvidePersistenceLayerDependencies(): void
    {
        $this->assertSame(
            $this->containerMock,
            $this->customerRegistrationDependencyProvider->providePersistenceLayerDependencies(
                $this->containerMock,
            ),
        );
    }
}
