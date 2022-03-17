<?php

namespace FondOfOryx\Zed\CountryOmsMailConnector\Communication\Plugin\OmsExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CountryOmsMailConnector\Business\CountryOmsMailConnectorFacade;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class CountryOmsOrderMailExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CountryOmsMailConnector\Business\CountryOmsMailConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderTransferMock;

    /**
     * @var \FondOfOryx\Zed\CountryOmsMailConnector\Communication\Plugin\OmsExtension\CountryOmsOrderMailExpanderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CountryOmsMailConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderTransferMock = $this->getMockBuilder(OrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CountryOmsOrderMailExpanderPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('expandOmsOrderMail')
            ->with($this->mailTransferMock, $this->orderTransferMock)
            ->willReturn($this->mailTransferMock);

        static::assertEquals(
            $this->mailTransferMock,
            $this->plugin->expand($this->mailTransferMock, $this->orderTransferMock),
        );
    }
}
