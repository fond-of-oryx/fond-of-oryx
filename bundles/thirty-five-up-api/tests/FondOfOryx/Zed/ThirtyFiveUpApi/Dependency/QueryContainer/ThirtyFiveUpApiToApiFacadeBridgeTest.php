<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\QueryContainer;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToApiFacadeBridge;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Zed\Api\Business\ApiFacadeInterface;

class ThirtyFiveUpApiToApiFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToApiFacadeBridge
     */
    protected $bridge;

    /**
     * @var \Spryker\Zed\Api\Business\ApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiFacadeMock;

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
        $this->apiFacadeMock = $this->getMockBuilder(ApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new ThirtyFiveUpApiToApiFacadeBridge(
            $this->apiFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testCreateApiItem(): void
    {
        $this->apiFacadeMock->expects($this->once())
            ->method('createApiItem')
            ->willReturn($this->apiItemTransferMock);

        $this->bridge->createApiItem($this->apiItemTransferMock, 1);
    }

    /**
     * @return void
     */
    public function testCreateApiCollection(): void
    {
        $this->apiFacadeMock->expects($this->once())
            ->method('createApiCollection')
            ->willReturn($this->collectionTransferMock);

        $this->bridge->createApiCollection([]);
    }
}
