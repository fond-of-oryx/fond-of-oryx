<?php

namespace FondOfOryx\Zed\JellyfishThirtyFiveUp\Communication;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishThirtyFiveUp\Dependency\Facade\JellyfishThirtyFiveUpToThirtyFiveUpFacadeBridge;
use FondOfOryx\Zed\JellyfishThirtyFiveUp\Dependency\Facade\JellyfishThirtyFiveUpToThirtyFiveUpFacadeInterface;
use FondOfOryx\Zed\JellyfishThirtyFiveUp\JellyfishThirtyFiveUpDependencyProvider;
use Spryker\Zed\Kernel\Container;

class JellyfishThirtyFiveUpCommunicationFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishThirtyFiveUp\Communication\JellyfishThirtyFiveUpCommunicationFactory
     */
    protected $factory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishThirtyFiveUp\Dependency\Facade\JellyfishThirtyFiveUpToThirtyFiveUpFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->facadeMock = $this->getMockBuilder(JellyfishThirtyFiveUpToThirtyFiveUpFacadeBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new JellyfishThirtyFiveUpCommunicationFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testGetThirtyFiveUpFacade(): void
    {
        $this->containerMock->expects($this->once())->method('has')->willReturn(true);
        $this->containerMock
            ->expects($this->once())
            ->method('get')
            ->with(JellyfishThirtyFiveUpDependencyProvider::FACADE_THIRTY_FIVE_UP)
            ->willReturn($this->facadeMock);

        $this->assertInstanceOf(JellyfishThirtyFiveUpToThirtyFiveUpFacadeInterface::class, $this->factory->getThirtyFiveUpFacade());
    }
}
