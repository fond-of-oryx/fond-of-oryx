<?php

namespace FondOfOryx\Zed\CustomerRegistrationSalesConnector\Communication\Plugin\Sales;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SpySalesOrderEntityTransfer;

class CustomerRegistrationCreateAccountOrderExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Communication\Plugin\Sales\CustomerRegistrationCreateAccountOrderExpanderPlugin
     */
    protected $plugin;

    /**
     * @var \Generated\Shared\Transfer\SpySalesOrderEntityTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderEntityTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->spySalesOrderEntityTransferMock = $this->getMockBuilder(SpySalesOrderEntityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CustomerRegistrationCreateAccountOrderExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExecute(): void
    {
        $this->spySalesOrderEntityTransferMock->expects(static::once())
            ->method('setCreateAccount')->willReturnSelf();

        $this->quoteTransferMock->expects(static::once())
            ->method('getCreateAccount')->willReturn(true);

        $this->plugin->expand($this->spySalesOrderEntityTransferMock, $this->quoteTransferMock);
    }
}
