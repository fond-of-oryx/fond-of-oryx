<?php

namespace FondOfOryx\Client\ProductListSearchRestApi\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\ProductListSearchRestApi\Dependency\Client\ProductListSearchRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\ProductListCollectionTransfer;

class ProductListSearchRestApiStubTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ProductListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $productListCollectionTransferMock;

    /**
     * @var \FondOfOryx\Client\ProductListSearchRestApi\Dependency\Client\ProductListSearchRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\ProductListSearchRestApi\Zed\ProductListSearchRestApiStub
     */
    protected $productListSearchRestApiStub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productListCollectionTransferMock = $this->getMockBuilder(ProductListCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(ProductListSearchRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListSearchRestApiStub = new ProductListSearchRestApiStub(
            $this->zedRequestClientMock,
        );
    }

    /**
     * @return void
     */
    public function testFindProductList(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                '/product-list-search-rest-api/gateway/find-product-list',
                $this->productListCollectionTransferMock,
            )->willReturn($this->productListCollectionTransferMock);

        static::assertEquals(
            $this->productListCollectionTransferMock,
            $this->productListSearchRestApiStub->findProductList($this->productListCollectionTransferMock),
        );
    }
}
