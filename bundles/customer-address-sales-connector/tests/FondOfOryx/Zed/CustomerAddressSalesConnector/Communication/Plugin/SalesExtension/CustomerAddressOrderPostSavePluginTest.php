<?php

namespace FondOfOryx\Zed\CustomerAddressSalesConnector\Communication\Plugin\SalesExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerAddressSalesConnector\Business\CustomerAddressSalesConnectorFacade;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;

class CustomerAddressOrderPostSavePluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\SaveOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $saveOrderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerAddressSalesConnector\Business\CustomerAddressSalesConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerAddressSalesConnector\Communication\Plugin\SalesExtension\CustomerAddressOrderPostSavePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->saveOrderTransferMock = $this->getMockBuilder(SaveOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(CustomerAddressSalesConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CustomerAddressOrderPostSavePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExecute(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('updateFkResourceCustomerAddressForSalesOrderAddress')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->saveOrderTransferMock,
            $this->plugin->execute($this->saveOrderTransferMock, $this->quoteTransferMock),
        );
    }
}
