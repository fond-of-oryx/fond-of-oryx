<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Generated\Shared\Transfer\RestProductListSearchPaginationTransfer;
use Generated\Shared\Transfer\RestProductListSearchResultItemTransfer;
use Generated\Shared\Transfer\RestProductListSearchSortTransfer;

class RestProductListSearchAttributesMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchResultItemMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restProductListSearchResultItemMapperMock;

    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchSortMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restProductListSearchSortMapperMock;

    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchPaginationMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restProductListSearchPaginationMapperMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $productListCollectionTransferMock;

    /**
     * @var array
     */
    protected $restProductListSearchResultItemTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\RestProductListSearchSortTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restProductListSearchSortTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListSearchPaginationTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restProductListSearchPaginationTransferMock;

    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestproductListSearchAttributesMapper
     */
    protected $restProductListSearchAttributesMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restProductListSearchResultItemMapperMock = $this->getMockBuilder(RestProductListSearchResultItemMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListSearchSortMapperMock = $this->getMockBuilder(RestProductListSearchSortMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListSearchPaginationMapperMock = $this->getMockBuilder(RestProductListSearchPaginationMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListSearchPaginationTransferMock = $this->getMockBuilder(RestProductListSearchPaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCollectionTransferMock = $this->getMockBuilder(ProductListCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListSearchResultItemTransferMocks = [
            $this->getMockBuilder(RestProductListSearchResultItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restProductListSearchSortTransferMock = $this->getMockBuilder(RestProductListSearchSortTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restproductListSearchPaginationTransferMock = $this->getMockBuilder(RestProductListSearchPaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListSearchAttributesMapper = new RestProductListSearchAttributesMapper(
            $this->restProductListSearchResultItemMapperMock,
            $this->restProductListSearchSortMapperMock,
            $this->restProductListSearchPaginationMapperMock,
        );
    }

    /**
     * @return void
     */
    public function testFromProductListCollection(): void
    {
        $productListCollection = new ArrayObject($this->restProductListSearchResultItemTransferMocks);

        $this->restProductListSearchResultItemMapperMock->expects(static::atLeastOnce())
            ->method('fromProductListCollection')
            ->with($this->productListCollectionTransferMock)
            ->willReturn($productListCollection);

        $this->restProductListSearchSortMapperMock->expects(static::atLeastOnce())
            ->method('fromProductListCollection')
            ->with($this->productListCollectionTransferMock)
            ->willReturn($this->restProductListSearchSortTransferMock);

        $this->restProductListSearchPaginationMapperMock->expects(static::atLeastOnce())
            ->method('fromProductListCollection')
            ->with($this->productListCollectionTransferMock)
            ->willReturn($this->restProductListSearchPaginationTransferMock);

        $restProductListSearchAttributesTransfer = $this->restProductListSearchAttributesMapper
            ->fromProductListCollection($this->productListCollectionTransferMock);

        static::assertEquals(
            $productListCollection,
            $restProductListSearchAttributesTransfer->getProductLists(),
        );

        static::assertEquals(
            $this->restProductListSearchSortTransferMock,
            $restProductListSearchAttributesTransfer->getSort(),
        );

        static::assertEquals(
            $this->restProductListSearchPaginationTransferMock,
            $restProductListSearchAttributesTransfer->getPagination(),
        );
    }
}
