<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Communication\Plugin\PostSave;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNote\Business\ErpDeliveryNoteFacade;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

class ErpDeliveryNoteItemPersisterErpDeliveryNotePostSavePluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\ErpDeliveryNoteFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNotePostSavePluginInterface
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->erpDeliveryNoteTransferMock = $this->getMockBuilder(ErpDeliveryNoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteFacadeMock = $this->getMockBuilder(ErpDeliveryNoteFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new ErpDeliveryNoteItemPersisterErpDeliveryNotePostSavePlugin();
        $this->plugin->setFacade($this->erpDeliveryNoteFacadeMock);
    }

    /**
     * @return void
     */
    public function testPostSave(): void
    {
        $this->erpDeliveryNoteFacadeMock->expects($this->once())->method('persistErpDeliveryNoteItem')->willReturn($this->erpDeliveryNoteTransferMock);

        $this->plugin->postSave($this->erpDeliveryNoteTransferMock);
    }
}
