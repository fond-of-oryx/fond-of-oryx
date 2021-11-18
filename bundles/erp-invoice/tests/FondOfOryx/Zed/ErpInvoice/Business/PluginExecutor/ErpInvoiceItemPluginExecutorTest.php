<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceItemPostSavePluginInterface;
use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceItemPreSavePluginInterface;
use Generated\Shared\Transfer\ErpInvoiceItemTransfer;

class ErpInvoiceItemPluginExecutorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceItemTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\ErpInvoiceFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceItemPreSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $preSavePluginMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceItemPostSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
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

        $this->erpInvoiceItemTransferMock = $this->getMockBuilder(ErpInvoiceItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->preSavePluginMock = $this->getMockBuilder(ErpInvoiceItemPreSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->postSavePluginMock = $this->getMockBuilder(ErpInvoiceItemPostSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return void
     */
    public function testExecutePostSavePlugins(): void
    {
        $this->postSavePluginMock->expects($this->once())->method('postSave')->willReturn($this->erpInvoiceItemTransferMock);
        $this->preSavePluginMock->expects($this->never())->method('preSave')->willReturn($this->erpInvoiceItemTransferMock);

        $pluginExecutor = new ErpInvoiceItemPluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);
        $pluginExecutor->executePostSavePlugins($this->erpInvoiceItemTransferMock);
    }

    /**
     * @return void
     */
    public function testExecutePreSavePlugins(): void
    {
        $this->postSavePluginMock->expects($this->never())->method('postSave')->willReturn($this->erpInvoiceItemTransferMock);
        $this->preSavePluginMock->expects($this->once())->method('preSave')->willReturn($this->erpInvoiceItemTransferMock);

        $pluginExecutor = new ErpInvoiceItemPluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);
        $pluginExecutor->executePreSavePlugins($this->erpInvoiceItemTransferMock);
    }
}
