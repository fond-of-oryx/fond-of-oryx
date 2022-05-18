<?php

namespace FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Api\Persistence\ApiQueryContainerInterface;

class GiftCardApiToApiQueryContainerBridgeTest extends Unit
{
    /**
     * @var \Spryker\Shared\Kernel\Transfer\AbstractTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $abstractTransferMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer\GiftCardApiToApiQueryContainerBridge
     */
    protected $apiQueryContainerBridge;

    /**
     * @var \Spryker\Zed\Api\Persistence\ApiQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiQueryQueryContainerMock;

    /**
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiItemTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiQueryQueryContainerMock = $this
            ->getMockBuilder(ApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->abstractTransferMock = $this->getMockBuilder(AbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiQueryContainerBridge =
            new GiftCardApiToApiQueryContainerBridge($this->apiQueryQueryContainerMock);
    }

    /**
     * @return void
     */
    public function testCreateApiCollection(): void
    {
        $data = [];
        $this->apiQueryQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiCollection')
            ->with($data)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertInstanceOf(
            ApiCollectionTransfer::class,
            $this->apiQueryContainerBridge->createApiCollection($data),
        );
    }

    /**
     * @return void
     */
    public function testCreateApiItem(): void
    {
        $this->apiQueryQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->abstractTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertInstanceOf(
            ApiItemTransfer::class,
            $this->apiQueryContainerBridge->createApiItem($this->abstractTransferMock),
        );
    }
}
