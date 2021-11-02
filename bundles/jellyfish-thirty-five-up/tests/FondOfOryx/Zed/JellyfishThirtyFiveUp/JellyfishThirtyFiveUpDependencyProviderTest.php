<?php

namespace FondOfOryx\Zed\JellyfishThirtyFiveUp;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacade;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class JellyfishThirtyFiveUpDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishThirtyFiveUp\JellyfishThirtyFiveUpDependencyProvider
     */
    protected $jellyfishThirtyFiveUpDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \Spryker\Zed\Kernel\Locator|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $locatorMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->thirtyFiveUpFacade = $this->getMockBuilder(ThirtyFiveUpFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishThirtyFiveUpDependencyProvider = new JellyfishThirtyFiveUpDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideCommunicationLayerDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->jellyfishThirtyFiveUpDependencyProvider->provideCommunicationLayerDependencies(
                $this->containerMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testAddThirtyFiveUpFacade(): void
    {
        $this->containerMock->method('getLocator')->willReturn($this->locatorMock);
        $this->jellyfishThirtyFiveUpDependencyProvider->addThirtyFiveUpFacade($this->containerMock);
    }
}
