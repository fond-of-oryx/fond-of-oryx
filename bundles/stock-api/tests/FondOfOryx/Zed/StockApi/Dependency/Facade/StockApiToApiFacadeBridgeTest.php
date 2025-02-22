<?php

namespace FondOfOryx\Zed\StockApi\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\StockTransfer;
use Spryker\Zed\Api\Business\ApiFacadeInterface;

class StockApiToApiFacadeBridgeTest extends Unit
{
    /**
     * @var \Spryker\Zed\Api\Business\ApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiItemTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiItemTransferMock;

    /**
     * @var \FondOfOryx\Zed\StockApi\Dependency\Facade\StockApiToApiFacadeBridge
     */
    protected $bridge;

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

        $this->facadeMock = $this->getMockBuilder(ApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new StockApiToApiFacadeBridge($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testCreateApiCollection()
    {
        $this->facadeMock->expects($this->atLeastOnce())
            ->method('createApiCollection')
            ->willReturn($this->apiCollectionTransferMock);

        $apiCollectionTransfer = $this->bridge->createApiCollection([]);

        $this->assertInstanceOf(ApiCollectionTransfer::class, $apiCollectionTransfer);
    }

    /**
     * @return void
     */
    public function testCreateApiItem()
    {
        $this->facadeMock->expects($this->atLeastOnce())
            ->method('createApiItem')
            ->willReturn($this->apiItemTransferMock);

        $apiItemTransfer = $this->bridge->createApiItem(new StockTransfer(), '1');

        $this->assertInstanceOf(ApiItemTransfer::class, $apiItemTransfer);
    }
}
