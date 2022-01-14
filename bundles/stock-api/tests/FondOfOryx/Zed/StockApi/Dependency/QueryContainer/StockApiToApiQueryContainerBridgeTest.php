<?php

namespace FondOfOryx\Zed\StockApi\Dependency\QueryContainer;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\StockTransfer;
use Spryker\Zed\Api\Persistence\ApiQueryContainerInterface;

class StockApiToApiQueryContainerBridgeTest extends Unit
{
    /**
     * @var \Spryker\Zed\Api\Persistence\ApiQueryContainer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiQueryContainerMock;

    /**
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiItemTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiItemTransferMock;

    /**
     * @var \FondOfOryx\Zed\StockApi\Dependency\QueryContainer\StockApiToApiQueryContainerBridge
     */
    protected $stockApiToApiBridge;

    /**
     * @return void
     */
    public function _before()
    {
        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiQueryContainerMock = $this->getMockBuilder(ApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockApiToApiBridge = new StockApiToApiQueryContainerBridge($this->apiQueryContainerMock);
    }

    /**
     * @return void
     */
    public function testCreateApiCollection()
    {
        $this->apiQueryContainerMock->expects($this->atLeastOnce())
            ->method('createApiCollection')
            ->willReturn($this->apiCollectionTransferMock);

        $apiCollectionTransfer = $this->stockApiToApiBridge->createApiCollection([]);

        $this->assertInstanceOf(ApiCollectionTransfer::class, $apiCollectionTransfer);
    }

    /**
     * @return void
     */
    public function testCreateApiItem()
    {
        $this->apiQueryContainerMock->expects($this->atLeastOnce())
            ->method('createApiItem')
            ->willReturn($this->apiItemTransferMock);

        $apiItemTransfer = $this->stockApiToApiBridge->createApiItem(new StockTransfer(), 1);

        $this->assertInstanceOf(ApiItemTransfer::class, $apiItemTransfer);
    }
}
