<?php

namespace FondOfOryx\Zed\Invoice\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\Invoice\Communication\Plugin\InvoiceExtension\AddressInvoicePreSavePlugin;
use FondOfOryx\Zed\Invoice\Communication\Plugin\InvoiceExtension\ItemsInvoicePostSavePlugin;
use Generated\Shared\Transfer\InvoiceTransfer;

class InvoicePluginExecutorTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\Invoice\Communication\Plugin\InvoiceExtension\AddressInvoicePreSavePlugin
     */
    protected $addressInvoicePreSavePluginMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\Invoice\Communication\Plugin\InvoiceExtension\ItemsInvoicePostSavePlugin
     */
    protected $itemsInvoicePostSavePluginMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\InvoiceTransfer
     */
    protected $invoiceTransferMock;

    /**
     * @var \FondOfOryx\Zed\Invoice\Business\Model\InvoicePluginExecutorInterface
     */
    protected $invoicePluginExecutor;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->addressInvoicePreSavePluginMock = $this->getMockBuilder(AddressInvoicePreSavePlugin::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemsInvoicePostSavePluginMock = $this->getMockBuilder(ItemsInvoicePostSavePlugin::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceTransferMock = $this->getMockBuilder(InvoiceTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoicePluginExecutor = new InvoicePluginExecutor([$this->addressInvoicePreSavePluginMock], [$this->itemsInvoicePostSavePluginMock]);
    }

    /**
     * @return void
     */
    public function testExecutePostSavePlugins(): void
    {
        $this->itemsInvoicePostSavePluginMock->expects(static::atLeastOnce())
            ->method('postSave')
            ->with($this->invoiceTransferMock)
            ->willReturn($this->invoiceTransferMock);

        static::assertEquals($this->invoiceTransferMock, $this->invoicePluginExecutor->executePostSavePlugins($this->invoiceTransferMock));
    }

    /**
     * @return void
     */
    public function testExecutePreSavePlugins(): void
    {
        $this->addressInvoicePreSavePluginMock->expects(static::atLeastOnce())
            ->method('preSave')
            ->willReturn($this->invoiceTransferMock)
            ->willReturn($this->invoiceTransferMock);

        static::assertEquals($this->invoiceTransferMock, $this->invoicePluginExecutor->executePreSavePlugins($this->invoiceTransferMock));
    }
}
