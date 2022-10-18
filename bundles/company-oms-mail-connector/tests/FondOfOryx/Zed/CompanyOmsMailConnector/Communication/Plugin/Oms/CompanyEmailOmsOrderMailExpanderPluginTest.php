<?php

namespace FondOfOryx\Zed\CompanyOmsMailConnector\Communication\Plugin\Oms;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyOmsMailConnector\Business\CompanyOmsMailConnectorFacade;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class CompanyEmailOmsOrderMailExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyOmsMailConnector\Communication\Plugin\Oms\CompanyEmailOmsOrderMailExpanderPlugin
     */
    protected $companyEmailOmsOrderMailExpanderPlugin;

    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyOmsMailConnector\Business\CompanyOmsMailConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyOmsMailConnectorFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderTransferMock = $this->getMockBuilder(OrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyOmsMailConnectorFacadeMock = $this->getMockBuilder(CompanyOmsMailConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyEmailOmsOrderMailExpanderPlugin = new CompanyEmailOmsOrderMailExpanderPlugin();
        $this->companyEmailOmsOrderMailExpanderPlugin->setFacade($this->companyOmsMailConnectorFacadeMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->companyOmsMailConnectorFacadeMock->expects(static::atLeastOnce())
            ->method('expandOrderMailTransferWithCompanyMailAddress')
            ->with($this->mailTransferMock, $this->orderTransferMock)
            ->willReturn($this->mailTransferMock);

        $mailTransfer = $this->companyEmailOmsOrderMailExpanderPlugin->expand(
            $this->mailTransferMock,
            $this->orderTransferMock,
        );

        static::assertEquals($mailTransfer, $this->mailTransferMock);
    }
}
