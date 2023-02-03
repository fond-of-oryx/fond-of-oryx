<?php

namespace FondOfOryx\Zed\ProductListApi\Dependency\QueryContainer;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductListApi\Dependency\Facade\ProductListApiToApiFacadeBridge;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Spryker\Zed\Api\Business\ApiFacadeInterface;

class ProductListApiToApiFacadeBridgeTest extends Unit
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
     * @var \FondOfOryx\Zed\ProductListApi\Dependency\Facade\ProductListApiToApiFacadeInterface
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this
            ->getMockBuilder(ApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this
            ->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new ProductListApiToApiFacadeBridge(
            $this->facadeMock,
        );
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

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->bridge
                ->createApiCollection([]),
        );
    }
}
