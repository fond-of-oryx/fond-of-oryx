<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoiceApi\Business\ErpInvoiceApiFacade;
use FondOfOryx\Zed\ErpInvoiceApi\Communication\Plugin\Api\ErpInvoiceApiValidatorPlugin;
use FondOfOryx\Zed\ErpInvoiceApi\ErpInvoiceApiConfig;
use Generated\Shared\Transfer\ApiRequestTransfer;

class ErpInvoiceApiValidatorPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Communication\Plugin\Api\ErpInvoiceApiValidatorPlugin
     */
    protected $erpInvoiceApiValidatorPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiRequestTransfer
     */
    protected $apiRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpInvoiceApi\Business\ErpInvoiceApiFacade
     */
    protected $erpInvoiceApiFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpInvoiceApiFacadeMock = $this->getMockBuilder(ErpInvoiceApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceApiValidatorPlugin = new ErpInvoiceApiValidatorPlugin();
        $this->erpInvoiceApiValidatorPlugin->setFacade($this->erpInvoiceApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        static::assertSame(
            ErpInvoiceApiConfig::RESOURCE_ERP_INVOICES,
            $this->erpInvoiceApiValidatorPlugin->getResourceName(),
        );
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $validationResult = [];

        $this->erpInvoiceApiFacadeMock->expects(static::atLeastOnce())
            ->method('validateErpInvoice')
            ->with($this->apiRequestTransferMock)
            ->willReturn($validationResult);

        static::assertEquals(
            $validationResult,
            $this->erpInvoiceApiValidatorPlugin->validate(
                $this->apiRequestTransferMock,
            ),
        );
    }
}
