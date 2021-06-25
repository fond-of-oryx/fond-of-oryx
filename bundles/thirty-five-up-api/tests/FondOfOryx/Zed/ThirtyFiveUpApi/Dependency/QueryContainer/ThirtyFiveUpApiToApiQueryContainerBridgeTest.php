<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\QueryContainer;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Zed\Api\Persistence\ApiQueryContainer;

class ThirtyFiveUpApiToApiQueryContainerBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryContainerBridge
     */
    protected $bridge;

    /**
     * @var \Spryker\Zed\Api\Persistence\ApiQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $queryContainerMock;

    /**
     * @var \Generated\Shared\Transfer\ApiItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiItemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $collectionTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->queryContainerMock = $this->getMockBuilder(ApiQueryContainer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new ThirtyFiveUpApiToApiQueryContainerBridge(
            $this->queryContainerMock
        );
    }

    /**
     * @return void
     */
    public function testCreateApiItem(): void
    {
        $this->queryContainerMock->expects($this->once())
            ->method('createApiItem')
            ->willReturn($this->apiItemTransferMock);

        $this->bridge->createApiItem($this->apiItemTransferMock, 1);
    }

    /**
     * @return void
     */
    public function testCreateApiCollection(): void
    {
        $this->queryContainerMock->expects($this->once())
            ->method('createApiCollection')
            ->willReturn($this->collectionTransferMock);

        $this->bridge->createApiCollection([]);
    }
}
