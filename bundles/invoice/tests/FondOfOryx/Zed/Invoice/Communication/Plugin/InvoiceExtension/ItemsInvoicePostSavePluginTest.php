<?php

namespace FondOfOryx\Zed\Invoice\Communication\Plugin\InvoiceExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\Invoice\Business\InvoiceFacade;
use Generated\Shared\Transfer\InvoiceTransfer;

class ItemsInvoicePostSavePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\Invoice\Business\InvoiceFacade
     */
    protected $facadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\InvoiceTransfer
     */
    protected $invoiceTransferMock;

    /**
     * @var \FondOfOryx\Zed\InvoiceExtension\Dependency\Plugin\InvoicePostSavePluginInterface
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(InvoiceFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceTransferMock = $this->getMockBuilder(InvoiceTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new ItemsInvoicePostSavePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testPostSave(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('createInvoiceItems')
            ->willReturn($this->invoiceTransferMock);

        static::assertEquals($this->invoiceTransferMock, $this->plugin->postSave($this->invoiceTransferMock));
    }
}
