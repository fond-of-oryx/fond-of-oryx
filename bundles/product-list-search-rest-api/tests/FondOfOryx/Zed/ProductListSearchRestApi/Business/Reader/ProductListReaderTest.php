<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Business\Reader;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductListSearchRestApi\Persistence\ProductListSearchRestApiRepositoryInterface;
use FondOfOryx\Zed\ProductListSearchRestApiExtension\Dependency\Plugin\SearchProductListQueryExpanderPluginInterface;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class ProductListReaderTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\ProductListSearchRestApi\Persistence\ProductListSearchRestApiRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ProductListSearchRestApiRepositoryInterface|MockObject $repositoryMock;

    /**
     * @var array<(\FondOfOryx\Zed\ProductListSearchRestApiExtension\Dependency\Plugin\SearchProductListQueryExpanderPluginInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $searchProductListQueryExpanderPluginMocks;

    /**
     * @var (\Generated\Shared\Transfer\ProductListCollectionTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ProductListCollectionTransfer|MockObject $productListCollectionTransferMock;

    /**
     * @var array<(\Generated\Shared\Transfer\FilterFieldTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var (\Generated\Shared\Transfer\QueryJoinCollectionTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|QueryJoinCollectionTransfer $queryJoinCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductListSearchRestApi\Business\Reader\ProductListReader
     */
    protected ProductListReader $productListReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ProductListSearchRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchProductListQueryExpanderPluginMocks = [
            $this->getMockBuilder(SearchProductListQueryExpanderPluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->productListCollectionTransferMock = $this->getMockBuilder(ProductListCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldTransferMocks = [
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->queryJoinCollectionTransferMock = $this->getMockBuilder(QueryJoinCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListReader = new ProductListReader(
            $this->repositoryMock,
            $this->searchProductListQueryExpanderPluginMocks,
        );
    }

    /**
     * @return void
     */
    public function testFindProductList(): void
    {
        $this->productListCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getFilterFields')
            ->willReturn(new ArrayObject($this->filterFieldTransferMocks));

        $this->searchProductListQueryExpanderPluginMocks[0]->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->filterFieldTransferMocks, static::callback(
                static fn (
                    QueryJoinCollectionTransfer $queryJoinCollectionTransfer
                ) => $queryJoinCollectionTransfer->getQueryJoins()->count() === 0
            ))->willReturn($this->queryJoinCollectionTransferMock);

        $this->productListCollectionTransferMock->expects(static::atLeastOnce())
            ->method('setQueryJoins')
            ->with($this->queryJoinCollectionTransferMock)
            ->willReturn($this->productListCollectionTransferMock);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findProductList')
            ->with($this->productListCollectionTransferMock)
            ->willReturn($this->productListCollectionTransferMock);

        static::assertEquals(
            $this->productListCollectionTransferMock,
            $this->productListReader->findProductList($this->productListCollectionTransferMock),
        );
    }
}
