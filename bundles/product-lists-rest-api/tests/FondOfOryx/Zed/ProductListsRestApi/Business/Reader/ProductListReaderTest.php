<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductListsRestApi\Dependency\Facade\ProductListsRestApiToProductListFacadeInterface;
use FondOfOryx\Zed\ProductListsRestApi\Persistence\ProductListsRestApiRepositoryInterface;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

class ProductListReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Persistence\ProductListsRestApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Dependency\Facade\ProductListsRestApiToProductListFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Business\Reader\ProductListReader
     */
    protected $productListReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ProductListsRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListFacadeMock = $this->getMockBuilder(ProductListsRestApiToProductListFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateRequestTransferMock = $this->getMockBuilder(RestProductListUpdateRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListReader = new ProductListReader(
            $this->repositoryMock,
            $this->productListFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetByRestProductListUpdateRequest(): void
    {
        $uuid = 'edac27d5-0bbb-43da-a39c-533fbd205485';
        $idProductList = 1;

        $this->restProductListUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductListId')
            ->willReturn($uuid);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdProductListByUuid')
            ->with($uuid)
            ->willReturn($idProductList);

        $this->productListFacadeMock->expects(static::atLeastOnce())
            ->method('getProductListById')
            ->with(
                static::callback(
                    static function (ProductListTransfer $productListTransfer) use ($idProductList) {
                        return $productListTransfer->getIdProductList() === $idProductList;
                    },
                ),
            )->willReturn($this->productListTransferMock);

        static::assertEquals(
            $this->productListTransferMock,
            $this->productListReader->getByRestProductListUpdateRequest($this->restProductListUpdateRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetByRestProductListUpdateRequestWithoutUuid(): void
    {
        $uuid = null;

        $this->restProductListUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductListId')
            ->willReturn($uuid);

        $this->repositoryMock->expects(static::never())
            ->method('getIdProductListByUuid');

        $this->productListFacadeMock->expects(static::never())
            ->method('getProductListById');

        static::assertEquals(
            null,
            $this->productListReader->getByRestProductListUpdateRequest($this->restProductListUpdateRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetByRestProductListUpdateRequestWithInvalidUuid(): void
    {
        $uuid = 'edac27d5-0bbb-43da-a39c-533fbd205485';
        $idProductList = null;

        $this->restProductListUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductListId')
            ->willReturn($uuid);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdProductListByUuid')
            ->with($uuid)
            ->willReturn($idProductList);

        $this->productListFacadeMock->expects(static::never())
            ->method('getProductListById');

        static::assertEquals(
            null,
            $this->productListReader->getByRestProductListUpdateRequest($this->restProductListUpdateRequestTransferMock),
        );
    }
}
