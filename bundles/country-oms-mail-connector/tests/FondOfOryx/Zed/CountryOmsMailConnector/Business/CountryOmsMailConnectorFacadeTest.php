<?php

namespace FondOfOryx\Zed\CountryOmsMailConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CountryOmsMailConnector\Business\Expander\OmsOrderMailExpanderInterface;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class CountryOmsMailConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CountryOmsMailConnector\Business\CountryOmsMailConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\CountryOmsMailConnector\Business\Expander\OmsOrderMailExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $omsOrderMailExpanderMock;

    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderTransferMock;

    /**
     * @var \FondOfOryx\Zed\CountryOmsMailConnector\Business\CountryOmsMailConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CountryOmsMailConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->omsOrderMailExpanderMock = $this->getMockBuilder(OmsOrderMailExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderTransferMock = $this->getMockBuilder(OrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CountryOmsMailConnectorFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testExpandOmsOrderMail(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createOmsOrderMailExpander')
            ->willReturn($this->omsOrderMailExpanderMock);

        $this->omsOrderMailExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->mailTransferMock, $this->orderTransferMock)
            ->willReturn($this->mailTransferMock);

        static::assertEquals(
            $this->mailTransferMock,
            $this->facade->expandOmsOrderMail($this->mailTransferMock, $this->orderTransferMock),
        );
    }
}
