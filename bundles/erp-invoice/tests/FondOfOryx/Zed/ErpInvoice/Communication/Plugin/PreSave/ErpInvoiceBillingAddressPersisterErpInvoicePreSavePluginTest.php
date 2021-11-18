<?php

namespace FondOfOryx\Zed\ErpInvoice\Communication\Plugin\PreSave;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoice\Business\ErpInvoiceFacade;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

class ErpInvoiceBillingAddressPersisterErpInvoicePreSavePluginTest extends Unit
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
     * @var \FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoicePreSavePluginInterface
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

        $this->plugin = new ErpInvoiceBillingAddressPersisterErpInvoicePreSavePlugin();
        $this->plugin->setFacade($this->erpInvoiceFacadeMock);
    }

    /**
     * @return void
     */
    public function testPostSave(): void
    {
        $this->erpInvoiceFacadeMock->expects($this->once())->method('persistBillingAddress')->willReturn($this->erpInvoiceTransferMock);

        $this->plugin->preSave($this->erpInvoiceTransferMock);
    }
}
