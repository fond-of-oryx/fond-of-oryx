<?php

namespace FondOfOryx\Zed\CustomerRegistrationSalesConnector\Communication\Plugin\Sales;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business\CustomerRegistrationSalesConnectorFacade;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;

class CustomerRegistrationCreateAccountOrderPostSavePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Communication\Plugin\Sales\CustomerRegistrationCreateAccountOrderPostSavePlugin
     */
    protected $plugin;

    /**
     * @var \Generated\Shared\Transfer\SaveOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $saveOrderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business\CustomerRegistrationSalesConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->saveOrderTransferMock = $this->getMockBuilder(SaveOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(CustomerRegistrationSalesConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CustomerRegistrationCreateAccountOrderPostSavePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExecute(): void
    {
        $this->facadeMock->expects(static::once())
            ->method('createCustomerAccount')->willReturn($this->saveOrderTransferMock);

        $this->plugin->execute($this->saveOrderTransferMock, $this->quoteTransferMock);
    }
}
