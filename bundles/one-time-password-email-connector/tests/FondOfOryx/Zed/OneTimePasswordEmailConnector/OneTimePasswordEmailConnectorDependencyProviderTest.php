<?php

namespace FondOfOryx\Zed\OneTimePasswordEmailConnector;

use Codeception\Test\Unit;
use Spryker\Zed\Kernel\Container;

class OneTimePasswordEmailConnectorDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePasswordEmailConnector\OneTimePasswordEmailConnectorDependencyProvider
     */
    protected $oneTimePasswordEmailConnectorDependencyProvider;

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

        $this->oneTimePasswordEmailConnectorDependencyProvider = new OneTimePasswordEmailConnectorDependencyProvider();
    }

    /**
     * @return void
     */
    public function testAddMailFacade(): void
    {
        $this->assertSame(
            $this->containerMock,
            $this->oneTimePasswordEmailConnectorDependencyProvider->provideBusinessLayerDependencies(
                $this->containerMock
            )
        );
    }
}
