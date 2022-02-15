<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteItemPostSavePluginInterface;
use FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteItemPreSavePluginInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer;

class ErpDeliveryNoteItemPluginExecutorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteItemTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\ErpDeliveryNoteFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteItemPreSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $preSavePluginMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteItemPostSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
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

        $this->erpDeliveryNoteItemTransferMock = $this->getMockBuilder(ErpDeliveryNoteItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->preSavePluginMock = $this->getMockBuilder(ErpDeliveryNoteItemPreSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->postSavePluginMock = $this->getMockBuilder(ErpDeliveryNoteItemPostSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return void
     */
    public function testExecutePostSavePlugins(): void
    {
        $this->postSavePluginMock->expects($this->once())->method('postSave')->willReturn($this->erpDeliveryNoteItemTransferMock);
        $this->preSavePluginMock->expects($this->never())->method('preSave')->willReturn($this->erpDeliveryNoteItemTransferMock);

        $pluginExecutor = new ErpDeliveryNoteItemPluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);
        $pluginExecutor->executePostSavePlugins($this->erpDeliveryNoteItemTransferMock);
    }

    /**
     * @return void
     */
    public function testExecutePreSavePlugins(): void
    {
        $this->postSavePluginMock->expects($this->never())->method('postSave')->willReturn($this->erpDeliveryNoteItemTransferMock);
        $this->preSavePluginMock->expects($this->once())->method('preSave')->willReturn($this->erpDeliveryNoteItemTransferMock);

        $pluginExecutor = new ErpDeliveryNoteItemPluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);
        $pluginExecutor->executePreSavePlugins($this->erpDeliveryNoteItemTransferMock);
    }
}
