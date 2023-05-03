<?php

namespace FondOfOryx\Zed\InvoiceApi\Dependency\QueryContainer;

use Codeception\Test\Unit;
use FondOfOryx\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToApiFacadeBridge;
use Generated\Shared\Transfer\ApiCollectionTransfer as ApiCollectionTransferAlias;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\InvoiceTransfer;
use Spryker\Zed\Api\Business\ApiFacadeInterface;

class InvoiceApiToApiFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Api\Business\ApiFacadeInterface
     */
    protected $facadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\InvoiceTransfer
     */
    protected $invoiceTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \FondOfOryx\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToApiFacadeBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(ApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransferAlias::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceTransferMock = $this->getMockBuilder(InvoiceTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new InvoiceApiToApiFacadeBridge($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testCreateApiCollection(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('createApiCollection')
            ->with([])
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals($this->apiCollectionTransferMock, $this->bridge->createApiCollection([]));
    }

    /**
     * @return void
     */
    public function testCreateApiItem(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->invoiceTransferMock, 1)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals($this->apiItemTransferMock, $this->bridge->createApiItem($this->invoiceTransferMock, '1'));
    }
}
