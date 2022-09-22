<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

class RestProductListSearchResultItemMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ProductListCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $productListCollectionTransferMock;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject>|array<\Generated\Shared\Transfer\ProductListTransfer>
     */
    protected $productListTransferMocks;

    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchResultItemMapper
     */
    protected $restProductListSearchResultItemMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productListCollectionTransferMock = $this->getMockBuilder(ProductListCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMocks = [
            $this->getMockBuilder(ProductListTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restProductListSearchResultItemMapper = new RestProductListSearchResultItemMapper();
    }

    /**
     * @return void
     */
    public function testFromProductList(): void
    {
        $uuid = 'uuid';

        $this->productListCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getProductLists')
            ->willReturn(new ArrayObject($this->productListTransferMocks));

        $this->productListTransferMocks[0]->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->productListTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn($uuid);

        $restProductListSearchResultItemTransfers = $this->restProductListSearchResultItemMapper
            ->fromProductListCollection($this->productListCollectionTransferMock);

        static::assertCount(1, $restProductListSearchResultItemTransfers);

        static::assertEquals(
            $uuid,
            $restProductListSearchResultItemTransfers->offsetGet(0)->getProductListId(),
        );
    }
}
