<?php

namespace FondOfOryx\Zed\OneTimePassword;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface;
use Spryker\Shared\Kernel\LocatorLocatorInterface;
use Spryker\Zed\Kernel\Container;

class OneTimePasswordDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\OneTimePasswordDependencyProvider
     */
    protected $oneTimePasswordDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\LocatorLocatorInterface
     */
    protected $locatorLocatorMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordEmailConnectorFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->locatorLocatorMock = $this->getMockBuilder(LocatorLocatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordEmailConnectorFacadeMock = $this->getMockBuilder(OneTimePasswordToOneTimePasswordEmailConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordDependencyProvider = new OneTimePasswordDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->assertSame(
            $this->containerMock,
            $this->oneTimePasswordDependencyProvider->provideBusinessLayerDependencies(
                $this->containerMock
            )
        );
    }

    /**
     * @return void
     */
    public function testProvidePersistenceLayerDependencies(): void
    {
        $this->assertSame(
            $this->containerMock,
            $this->oneTimePasswordDependencyProvider->providePersistenceLayerDependencies(
                $this->containerMock
            )
        );
    }
}
