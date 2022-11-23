<?php

namespace FondOfOryx\Client\CustomerRegistrationRestApi;

use Codeception\Test\Unit;
use Spryker\Client\Kernel\Container;

class CustomerRegistrationRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\CustomerRegistrationRestApi\CustomerRegistrationRestApiDependencyProvider
     */
    protected $customerRegistrationRestApiDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
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

        $this->customerRegistrationRestApiDependencyProvider = new CustomerRegistrationRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProviderServiceLayerDependencies(): void
    {
        $this->assertSame(
            $this->containerMock,
            $this->customerRegistrationRestApiDependencyProvider->provideServiceLayerDependencies(
                $this->containerMock,
            ),
        );
    }
}
