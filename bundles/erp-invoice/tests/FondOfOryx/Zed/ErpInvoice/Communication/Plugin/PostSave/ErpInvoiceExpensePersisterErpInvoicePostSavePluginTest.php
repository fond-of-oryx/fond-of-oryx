<?php

namespace FondOfOryx\Zed\ErpInvoice\Communication\Plugin\PostSave;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoice\Business\ErpInvoiceFacade;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

class ErpInvoiceExpensePersisterErpInvoicePostSavePluginTest extends Unit
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

        $this->plugin = new ErpInvoiceExpensePersisterErpInvoicePostSavePlugin();
        $this->plugin->setFacade($this->erpInvoiceFacadeMock);
    }

    /**
     * @return void
     */
    public function testPostSave(): void
    {
        $this->erpInvoiceFacadeMock->expects($this->once())->method('persistErpInvoiceExpense')->willReturn($this->erpInvoiceTransferMock);

        $this->plugin->postSave($this->erpInvoiceTransferMock);
    }
}
