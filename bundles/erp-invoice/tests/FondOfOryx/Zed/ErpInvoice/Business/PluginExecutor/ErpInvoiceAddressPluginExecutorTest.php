<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAddressPostSavePluginInterface;
use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAddressPreSavePluginInterface;
use Generated\Shared\Transfer\ErpInvoiceAddressTransfer;

class ErpInvoiceAddressPluginExecutorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceAddressTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\ErpInvoiceFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAddressPreSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $preSavePluginMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAddressPostSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
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

        $this->erpInvoiceAddressTransferMock = $this->getMockBuilder(ErpInvoiceAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->preSavePluginMock = $this->getMockBuilder(ErpInvoiceAddressPreSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->postSavePluginMock = $this->getMockBuilder(ErpInvoiceAddressPostSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return void
     */
    public function testExecutePostSavePlugins(): void
    {
        $this->postSavePluginMock->expects($this->once())->method('postSave')->willReturn($this->erpInvoiceAddressTransferMock);
        $this->preSavePluginMock->expects($this->never())->method('preSave')->willReturn($this->erpInvoiceAddressTransferMock);

        $pluginExecutor = new ErpInvoiceAddressPluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);
        $pluginExecutor->executePostSavePlugins($this->erpInvoiceAddressTransferMock);
    }

    /**
     * @return void
     */
    public function testExecutePreSavePlugins(): void
    {
        $this->postSavePluginMock->expects($this->never())->method('postSave')->willReturn($this->erpInvoiceAddressTransferMock);
        $this->preSavePluginMock->expects($this->once())->method('preSave')->willReturn($this->erpInvoiceAddressTransferMock);

        $pluginExecutor = new ErpInvoiceAddressPluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);
        $pluginExecutor->executePreSavePlugins($this->erpInvoiceAddressTransferMock);
    }
}
