<?php

namespace FondOfOryx\Zed\OneTimePasswordEmailConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\Dependency\Facade\OneTimePasswordEmailConnectorToMailBridge;
use FondOfOryx\Zed\OneTimePasswordEmailConnector\OneTimePasswordEmailConnectorDependencyProvider;
use Spryker\Zed\Kernel\Container;

class OneTimePasswordEmailConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\OneTimePasswordEmailConnectorBusinessFactory
     */
    protected $oneTimePasswordEmailConnectorBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\Dependency\Facade\OneTimePasswordEmailConnectorToMailBridge|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailBridgeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailBridgeMock = $this->getMockBuilder(OneTimePasswordEmailConnectorToMailBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordEmailConnectorBusinessFactory = new OneTimePasswordEmailConnectorBusinessFactory();
        $this->oneTimePasswordEmailConnectorBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateOneTimePasswordEmailConnector(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(OneTimePasswordEmailConnectorDependencyProvider::FACADE_MAIL)
            ->willReturn($this->mailBridgeMock);

        $this->assertInstanceOf(
            OneTimePasswordEmailConnectorInterface::class,
            $this->oneTimePasswordEmailConnectorBusinessFactory->createOneTimePasswordEmailConnector()
        );
    }
}
