<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoiceApi\Business\ErpInvoiceApiFacade;
use FondOfOryx\Zed\ErpInvoiceApi\Communication\Plugin\Api\ErpInvoiceApiResourcePlugin;
use FondOfOryx\Zed\ErpInvoiceApi\ErpInvoiceApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class ErpInvoiceApiResourcePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpInvoiceApi\Business\ErpInvoiceApiFacade
     */
    protected $erpInvoiceApiFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiRequestTransfer
     */
    protected $apiRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected $apiCollectionTransferMock;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Communication\Plugin\Api\ErpInvoiceApiResourcePlugin
     */
    protected $erpInvoiceApiResourcePlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpInvoiceApiFacadeMock = $this->getMockBuilder(ErpInvoiceApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->id = 1;

        $this->erpInvoiceApiResourcePlugin = new ErpInvoiceApiResourcePlugin();
        $this->erpInvoiceApiResourcePlugin->setFacade($this->erpInvoiceApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        static::assertSame(
            ErpInvoiceApiConfig::RESOURCE_ERP_INVOICES,
            $this->erpInvoiceApiResourcePlugin->getResourceName(),
        );
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->erpInvoiceApiFacadeMock->expects(static::atLeastOnce())
            ->method('createErpInvoice')
            ->with($this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpInvoiceApiResourcePlugin->add(
                $this->apiDataTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $this->erpInvoiceApiFacadeMock->expects(static::atLeastOnce())
            ->method('getErpInvoice')
            ->with($this->id)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpInvoiceApiResourcePlugin->get(
                $this->id,
            ),
        );
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->erpInvoiceApiFacadeMock->expects(static::atLeastOnce())
            ->method('updateErpInvoice')
            ->with($this->id, $this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpInvoiceApiResourcePlugin->update(
                $this->id,
                $this->apiDataTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {
        $this->erpInvoiceApiFacadeMock->expects(static::atLeastOnce())
            ->method('deleteErpInvoice')
            ->with($this->id)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpInvoiceApiResourcePlugin->remove(
                $this->id,
            ),
        );
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $this->erpInvoiceApiFacadeMock->expects(static::atLeastOnce())
            ->method('findErpInvoices')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->erpInvoiceApiResourcePlugin->find(
                $this->apiRequestTransferMock,
            ),
        );
    }
}
