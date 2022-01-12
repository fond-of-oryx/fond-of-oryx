<?php

namespace FondOfOryx\Zed\InvoiceApi\Dependency\QueryContainer;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiCollectionTransfer as ApiCollectionTransferAlias;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\InvoiceTransfer;
use Spryker\Zed\Api\Persistence\ApiQueryContainer;

class InvoiceApiToApiQueryContainerBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Api\Persistence\ApiQueryContainer
     */
    protected $apiQueryContainerMock;

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
     * @var \FondOfOryx\Zed\InvoiceApi\Dependency\QueryContainer\InvoiceApiToApiQueryContainerBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiQueryContainerMock = $this->getMockBuilder(ApiQueryContainer::class)
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

        $this->bridge = new InvoiceApiToApiQueryContainerBridge($this->apiQueryContainerMock);
    }

    /**
     * @return void
     */
    public function testCreateApiCollection(): void
    {
        $this->apiQueryContainerMock->expects(static::atLeastOnce())
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
        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->invoiceTransferMock, 1)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals($this->apiItemTransferMock, $this->bridge->createApiItem($this->invoiceTransferMock, 1));
    }
}
