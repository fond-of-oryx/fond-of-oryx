<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceExpensePostSavePluginInterface;
use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceExpensePreSavePluginInterface;
use Generated\Shared\Transfer\ErpInvoiceExpenseTransfer;

class ErpInvoiceExpensePluginExecutorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceExpenseTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\ErpInvoiceFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceExpensePreSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $preSavePluginMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceExpensePostSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
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

        $this->erpInvoiceExpenseTransferMock = $this->getMockBuilder(ErpInvoiceExpenseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->preSavePluginMock = $this->getMockBuilder(ErpInvoiceExpensePreSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->postSavePluginMock = $this->getMockBuilder(ErpInvoiceExpensePostSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return void
     */
    public function testExecutePostSavePlugins(): void
    {
        $this->postSavePluginMock->expects($this->once())->method('postSave')->willReturn($this->erpInvoiceExpenseTransferMock);
        $this->preSavePluginMock->expects($this->never())->method('preSave')->willReturn($this->erpInvoiceExpenseTransferMock);

        $pluginExecutor = new ErpInvoiceExpensePluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);
        $pluginExecutor->executePostSavePlugins($this->erpInvoiceExpenseTransferMock);
    }

    /**
     * @return void
     */
    public function testExecutePreSavePlugins(): void
    {
        $this->postSavePluginMock->expects($this->never())->method('postSave')->willReturn($this->erpInvoiceExpenseTransferMock);
        $this->preSavePluginMock->expects($this->once())->method('preSave')->willReturn($this->erpInvoiceExpenseTransferMock);

        $pluginExecutor = new ErpInvoiceExpensePluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);
        $pluginExecutor->executePreSavePlugins($this->erpInvoiceExpenseTransferMock);
    }
}
