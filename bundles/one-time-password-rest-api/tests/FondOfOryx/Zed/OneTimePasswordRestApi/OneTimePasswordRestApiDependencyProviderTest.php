<?php

namespace FondOfOryx\Zed\OneTimePasswordRestApi;

use Codeception\Test\Unit;
use Spryker\Zed\Kernel\Container;

class OneTimePasswordRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePasswordRestApi\OneTimePasswordRestApiDependencyProvider
     */
    protected $oneTimePasswordRestApiDependencyProvider;

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

        $this->oneTimePasswordRestApiDependencyProvider = new OneTimePasswordRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->assertSame(
            $this->containerMock,
            $this->oneTimePasswordRestApiDependencyProvider->provideBusinessLayerDependencies(
                $this->containerMock
            )
        );
    }
}
