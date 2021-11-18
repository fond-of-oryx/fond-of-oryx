<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoicePostSavePluginInterface;
use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoicePreSavePluginInterface;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

class ErpInvoicePluginExecutorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\ErpInvoiceFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoicePreSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $preSavePluginMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoicePostSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
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

        $this->erpInvoiceTransferMock = $this->getMockBuilder(ErpInvoiceTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->preSavePluginMock = $this->getMockBuilder(ErpInvoicePreSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->postSavePluginMock = $this->getMockBuilder(ErpInvoicePostSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return void
     */
    public function testExecutePostSavePlugins(): void
    {
        $this->postSavePluginMock->expects($this->once())->method('postSave')->willReturn($this->erpInvoiceTransferMock);
        $this->preSavePluginMock->expects($this->never())->method('preSave')->willReturn($this->erpInvoiceTransferMock);

        $pluginExecutor = new ErpInvoicePluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);
        $pluginExecutor->executePostSavePlugins($this->erpInvoiceTransferMock);
    }

    /**
     * @return void
     */
    public function testExecutePreSavePlugins(): void
    {
        $this->postSavePluginMock->expects($this->never())->method('postSave')->willReturn($this->erpInvoiceTransferMock);
        $this->preSavePluginMock->expects($this->once())->method('preSave')->willReturn($this->erpInvoiceTransferMock);

        $pluginExecutor = new ErpInvoicePluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);
        $pluginExecutor->executePreSavePlugins($this->erpInvoiceTransferMock);
    }
}
