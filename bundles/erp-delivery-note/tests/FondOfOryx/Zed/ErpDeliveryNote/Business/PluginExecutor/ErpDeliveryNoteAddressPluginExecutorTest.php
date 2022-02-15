<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteAddressPostSavePluginInterface;
use FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteAddressPreSavePluginInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer;

class ErpDeliveryNoteAddressPluginExecutorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteAddressTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\ErpDeliveryNoteFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteAddressPreSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $preSavePluginMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteAddressPostSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $postSavePluginMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNotePreSavePluginInterface
     */
    protected $pluginExecutor;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->erpDeliveryNoteAddressTransferMock = $this->getMockBuilder(ErpDeliveryNoteAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->preSavePluginMock = $this->getMockBuilder(ErpDeliveryNoteAddressPreSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->postSavePluginMock = $this->getMockBuilder(ErpDeliveryNoteAddressPostSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return void
     */
    public function testExecutePostSavePlugins(): void
    {
        $this->postSavePluginMock->expects($this->once())->method('postSave')->willReturn($this->erpDeliveryNoteAddressTransferMock);
        $this->preSavePluginMock->expects($this->never())->method('preSave')->willReturn($this->erpDeliveryNoteAddressTransferMock);

        $pluginExecutor = new ErpDeliveryNoteAddressPluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);
        $pluginExecutor->executePostSavePlugins($this->erpDeliveryNoteAddressTransferMock);
    }

    /**
     * @return void
     */
    public function testExecutePreSavePlugins(): void
    {
        $this->postSavePluginMock->expects($this->never())->method('postSave')->willReturn($this->erpDeliveryNoteAddressTransferMock);
        $this->preSavePluginMock->expects($this->once())->method('preSave')->willReturn($this->erpDeliveryNoteAddressTransferMock);

        $pluginExecutor = new ErpDeliveryNoteAddressPluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);
        $pluginExecutor->executePreSavePlugins($this->erpDeliveryNoteAddressTransferMock);
    }
}
