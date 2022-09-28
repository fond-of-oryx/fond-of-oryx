<?php

namespace FondOfOryx\Client\ProductListsRestApi\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\ProductListsRestApi\Dependency\Client\ProductListsRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Generated\Shared\Transfer\RestProductListUpdateResponseTransfer;

class ProductListsRestApiStubTest extends Unit
{
 /**
  * @var \FondOfOryx\Client\ProductListsRestApi\Zed\ProductListsRestApiStub
  */
    protected $productListsRestApiStub;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateResponseTransferMock;

    /**
     * @var \FondOfOryx\Client\ProductListsRestApi\Dependency\Client\ProductListsRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restProductListUpdateRequestTransferMock = $this->getMockBuilder(RestProductListUpdateRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateResponseTransferMock = $this->getMockBuilder(RestProductListUpdateResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(ProductListsRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListsRestApiStub = new ProductListsRestApiStub(
            $this->zedRequestClientMock,
        );
    }

    /**
     * @return void
     */
    public function testSearchProductList(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                '/product-lists-rest-api/gateway/update-product-list-by-rest-product-list-update-request',
                $this->restProductListUpdateRequestTransferMock,
            )->willReturn($this->restProductListUpdateResponseTransferMock);

        static::assertEquals(
            $this->restProductListUpdateResponseTransferMock,
            $this->productListsRestApiStub->updateProductListByRestProductListUpdateRequest(
                $this->restProductListUpdateRequestTransferMock,
            ),
        );
    }
}
