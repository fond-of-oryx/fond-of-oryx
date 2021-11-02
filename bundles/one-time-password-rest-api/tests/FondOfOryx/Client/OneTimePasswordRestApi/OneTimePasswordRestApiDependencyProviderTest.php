<?php

namespace FondOfOryx\Client\OneTimePasswordRestApi;

use Codeception\Test\Unit;
use Spryker\Client\Kernel\Container;

class OneTimePasswordRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\OneTimePasswordRestApi\OneTimePasswordRestApiDependencyProvider
     */
    protected $oneTimePasswordRestApiDependencyProvider;

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

        $this->oneTimePasswordRestApiDependencyProvider = new OneTimePasswordRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProviderServiceLayerDependencies(): void
    {
        $this->assertSame(
            $this->containerMock,
            $this->oneTimePasswordRestApiDependencyProvider->provideServiceLayerDependencies(
                $this->containerMock,
            ),
        );
    }
}
