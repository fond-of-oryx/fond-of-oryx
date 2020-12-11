<?php

namespace FondOfOryx\Zed\SalesLocaleConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SalesLocaleConnector\Business\Model\OrderExpanderInterface;
use Generated\Shared\Transfer\OrderTransfer;

class SalesLocaleConnectorFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\SalesLocaleConnector\Business\SalesLocaleConnectorBusinessFactory
     */
    protected $salesLocaleConnectorBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\SalesLocaleConnector\Business\Model\OrderExpanderInterface
     */
    protected $orderExpanderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\OrderTransfer
     */
    protected $orderTransferMock;

    /**
     * @var \FondOfOryx\Zed\SalesLocaleConnector\Business\SalesLocaleConnectorFacade
     */
    protected $salesLocaleConnectorFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->salesLocaleConnectorBusinessFactoryMock = $this->getMockBuilder(SalesLocaleConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderExpanderMock = $this->getMockBuilder(OrderExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderTransferMock = $this->getMockBuilder(OrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesLocaleConnectorFacade = new SalesLocaleConnectorFacade();
        $this->salesLocaleConnectorFacade->setFactory($this->salesLocaleConnectorBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testHydrateSalesOrderAddress(): void
    {
        $this->salesLocaleConnectorBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createOrderExpander')
            ->willReturn($this->orderExpanderMock);

        $this->orderExpanderMock->expects($this->atLeastOnce())
            ->method('expand')
            ->with($this->orderTransferMock)
            ->willReturn($this->orderTransferMock);

        $orderTransfer = $this->salesLocaleConnectorFacade->expandOrder(
            $this->orderTransferMock
        );

        $this->assertEquals($this->orderTransferMock, $orderTransfer);
    }
}
