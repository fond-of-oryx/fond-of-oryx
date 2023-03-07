<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteTrackingPostSavePluginInterface;
use FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteTrackingPreSavePluginInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer;

class ErpDeliveryNoteTrackingPluginExecutorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteTrackingTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\ErpDeliveryNoteFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteTrackingPreSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $preSavePluginMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteTrackingPostSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
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

        $this->erpDeliveryNoteTrackingTransferMock = $this->getMockBuilder(ErpDeliveryNoteTrackingTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->preSavePluginMock = $this->getMockBuilder(ErpDeliveryNoteTrackingPreSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->postSavePluginMock = $this->getMockBuilder(ErpDeliveryNoteTrackingPostSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return void
     */
    public function testExecutePostSavePlugins(): void
    {
        $this->postSavePluginMock->expects($this->once())->method('postSave')->willReturn($this->erpDeliveryNoteTrackingTransferMock);
        $this->preSavePluginMock->expects($this->never())->method('preSave')->willReturn($this->erpDeliveryNoteTrackingTransferMock);

        $pluginExecutor = new ErpDeliveryNoteTrackingPluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);
        $pluginExecutor->executePostSavePlugins($this->erpDeliveryNoteTrackingTransferMock);
    }

    /**
     * @return void
     */
    public function testExecutePreSavePlugins(): void
    {
        $this->postSavePluginMock->expects($this->never())->method('postSave')->willReturn($this->erpDeliveryNoteTrackingTransferMock);
        $this->preSavePluginMock->expects($this->once())->method('preSave')->willReturn($this->erpDeliveryNoteTrackingTransferMock);

        $pluginExecutor = new ErpDeliveryNoteTrackingPluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);
        $pluginExecutor->executePreSavePlugins($this->erpDeliveryNoteTrackingTransferMock);
    }
}
