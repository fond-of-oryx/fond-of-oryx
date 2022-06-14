<?php

namespace FondOfOryx\Zed\ProductListApi\Dependency\QueryContainer;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Spryker\Zed\Api\Persistence\ApiQueryContainerInterface;

class ProductListApiToApiQueryContainerBridgeTest extends Unit
{
    /**
     * @var \Spryker\Zed\Api\Persistence\ApiQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiQueryContainerMock;

    /**
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductListApi\Dependency\QueryContainer\ProductListApiToApiQueryContainerInterface
     */
    protected $dependencyApiQueryContainer;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiQueryContainerMock = $this
            ->getMockBuilder(ApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this
            ->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyApiQueryContainer = new ProductListApiToApiQueryContainerBridge(
            $this->apiQueryContainerMock,
        );
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

        static::assertInstanceOf(
            ApiCollectionTransfer::class,
            $this->dependencyApiQueryContainer
                ->createApiCollection([]),
        );
    }
}
