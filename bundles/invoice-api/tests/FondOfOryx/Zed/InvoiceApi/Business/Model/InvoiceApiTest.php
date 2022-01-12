<?php

namespace FondOfOryx\Zed\InvoiceApi\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\InvoiceApi\Business\Mapper\TransferMapper;
use FondOfOryx\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToInvoiceFacadeBridge;
use FondOfOryx\Zed\InvoiceApi\Dependency\QueryContainer\InvoiceApiToApiQueryContainerBridge;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\InvoiceResponseTransfer;
use Generated\Shared\Transfer\InvoiceTransfer;

class InvoiceApiTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\InvoiceApi\Business\InvoiceApiFacade
     */
    protected $facadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\InvoiceApi\Dependency\QueryContainer\InvoiceApiToApiQueryContainerBridge
     */
    protected $apiQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\InvoiceApi\Business\Mapper\TransferMapper
     */
    protected $transferMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\InvoiceTransfer
     */
    protected $invoiceTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\InvoiceResponseTransfer
     */
    protected $invoiceResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \FondOfOryx\Zed\InvoiceApi\Business\Model\InvoiceApi
     */
    protected $invoiceApi;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(InvoiceApiToInvoiceFacadeBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiQueryContainerMock = $this->getMockBuilder(InvoiceApiToApiQueryContainerBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferMapperMock = $this->getMockBuilder(TransferMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceTransferMock = $this->getMockBuilder(InvoiceTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceResponseTransferMock = $this->getMockBuilder(InvoiceResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceApi = new InvoiceApi($this->apiQueryContainerMock, $this->transferMapperMock, $this->facadeMock);
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn([]);

        $this->transferMapperMock->expects(static::atLeastOnce())
            ->method('toTransfer')
            ->with([])
            ->willReturn($this->invoiceTransferMock);

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('createInvoice')
            ->with($this->invoiceTransferMock)
            ->willReturn($this->invoiceResponseTransferMock);

        $this->invoiceResponseTransferMock->expects(static::atLeastOnce())
            ->method('getInvoiceTransfer')
            ->willReturn($this->invoiceTransferMock);

        $this->invoiceResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccess')
            ->willReturn(true);

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->invoiceTransferMock, 1)
            ->willReturn($this->apiItemTransferMock);

        $this->invoiceTransferMock->expects(static::atLeastOnce())
            ->method('getIdInvoice')
            ->willReturn(1);

        static::assertEquals($this->apiItemTransferMock, $this->invoiceApi->add($this->apiDataTransferMock));
    }
}
