<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\ProductList\Business\ProductListFacadeInterface;

class ProductListsRestApiToProductListFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\ProductList\Business\ProductListFacadeInterface
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Dependency\Facade\ProductListsRestApiToProductListFacadeBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(ProductListFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListResponseTransferMock = $this->getMockBuilder(ProductListResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new ProductListsRestApiToProductListFacadeBridge($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testGetProductListById(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('getProductListById')
            ->with($this->productListTransferMock)
            ->willReturn($this->productListTransferMock);

        static::assertEquals(
            $this->productListTransferMock,
            $this->bridge->getProductListById($this->productListTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testUpdateProductList(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('updateProductList')
            ->with($this->productListTransferMock)
            ->willReturn($this->productListResponseTransferMock);

        static::assertEquals(
            $this->productListResponseTransferMock,
            $this->bridge->updateProductList($this->productListTransferMock),
        );
    }
}
