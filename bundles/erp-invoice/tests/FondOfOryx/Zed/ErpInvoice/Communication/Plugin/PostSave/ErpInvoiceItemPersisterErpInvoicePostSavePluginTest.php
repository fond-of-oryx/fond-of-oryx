<?php

namespace FondOfOryx\Zed\ErpInvoice\Communication\Plugin\PostSave;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoice\Business\ErpInvoiceFacade;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

class ErpInvoiceItemPersisterErpInvoicePostSavePluginTest extends Unit
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
     * @var \FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoicePostSavePluginInterface
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->erpInvoiceTransferMock = $this->getMockBuilder(ErpInvoiceTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceFacadeMock = $this->getMockBuilder(ErpInvoiceFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new ErpInvoiceItemPersisterErpInvoicePostSavePlugin();
        $this->plugin->setFacade($this->erpInvoiceFacadeMock);
    }

    /**
     * @return void
     */
    public function testPostSave(): void
    {
        $this->erpInvoiceFacadeMock->expects($this->once())->method('persistErpInvoiceItem')->willReturn($this->erpInvoiceTransferMock);

        $this->plugin->postSave($this->erpInvoiceTransferMock);
    }
}
