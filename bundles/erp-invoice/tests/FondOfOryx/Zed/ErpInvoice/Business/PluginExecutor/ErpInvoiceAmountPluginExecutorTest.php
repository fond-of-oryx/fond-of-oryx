<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAmountPostSavePluginInterface;
use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAmountPreSavePluginInterface;
use Generated\Shared\Transfer\ErpInvoiceAmountTransfer;

class ErpInvoiceAmountPluginExecutorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceAmountTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceTotalTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\ErpInvoiceFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAmountPreSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $preSavePluginMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAmountPostSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $postSavePluginMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoicePreSavePluginInterface
     */
    protected $pluginExecutor;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->erpInvoiceTotalTransferMock = $this->getMockBuilder(ErpInvoiceAmountTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->preSavePluginMock = $this->getMockBuilder(ErpInvoiceAmountPreSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->postSavePluginMock = $this->getMockBuilder(ErpInvoiceAmountPostSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return void
     */
    public function testExecutePostSavePlugins(): void
    {
        $this->postSavePluginMock->expects($this->once())->method('postSave')->willReturn($this->erpInvoiceTotalTransferMock);
        $pluginExecutor = new ErpInvoiceAmountPluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);

        $pluginExecutor->executePostSavePlugins($this->erpInvoiceTotalTransferMock);
    }

    /**
     * @return void
     */
    public function testExecutePreSavePlugins(): void
    {
        $this->preSavePluginMock->expects($this->once())->method('preSave')->willReturn($this->erpInvoiceTotalTransferMock);
        $pluginExecutor = new ErpInvoiceAmountPluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);

        $pluginExecutor->executePreSavePlugins($this->erpInvoiceTotalTransferMock);
    }
}
