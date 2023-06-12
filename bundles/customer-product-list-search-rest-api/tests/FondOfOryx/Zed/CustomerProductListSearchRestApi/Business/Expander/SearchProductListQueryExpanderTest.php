<?php

namespace FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Reader\ProductListReader;
use FondOfOryx\Zed\CustomerProductListSearchRestApi\Dependency\Service\CustomerProductListSearchRestApiToUtilEncodingServiceInterface;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListTableMap;
use PHPUnit\Framework\MockObject\MockObject;
use Propel\Runtime\ActiveQuery\Criteria;

class SearchProductListQueryExpanderTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Reader\ProductListReader&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|ProductListReader $productListReaderMock;

    /**
     * @var (\FondOfOryx\Zed\CustomerProductListSearchRestApi\Dependency\Service\CustomerProductListSearchRestApiToUtilEncodingServiceInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerProductListSearchRestApiToUtilEncodingServiceInterface|MockObject $utilEncodingServiceMock;

    /**
     * @var (\Generated\Shared\Transfer\QueryJoinCollectionTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|QueryJoinCollectionTransfer $queryJoinCollectionTransferMock;

    /**
     * @var array<(\Generated\Shared\Transfer\FilterFieldTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Expander\SearchProductListQueryExpander
     */
    protected SearchProductListQueryExpander $searchProductListQueryExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productListReaderMock = $this->getMockBuilder(ProductListReader::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->utilEncodingServiceMock = $this->getMockBuilder(CustomerProductListSearchRestApiToUtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryJoinCollectionTransferMock = $this->getMockBuilder(QueryJoinCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldTransferMocks = [
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->searchProductListQueryExpander = new SearchProductListQueryExpander(
            $this->productListReaderMock,
            $this->utilEncodingServiceMock,
        );
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $productListIds = [1, 3, 4, 5];
        $json = json_encode($productListIds);

        $this->productListReaderMock->expects(static::atLeastOnce())
            ->method('getIdsByFilterFields')
            ->with($this->filterFieldTransferMocks)
            ->willReturn($productListIds);

        $this->utilEncodingServiceMock->expects(static::atLeastOnce())
            ->method('encodeJson')
            ->with($productListIds, null, null)
            ->willReturn($json);

        $this->queryJoinCollectionTransferMock->expects(static::atLeastOnce())
            ->method('addQueryJoin')
            ->with(
                static::callback(
                    fn (
                        QueryJoinTransfer $queryJoinTransfer
                    ) => $queryJoinTransfer->getWhereConditions()->count() === 1
                        && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getColumn() === SpyProductListTableMap::COL_ID_PRODUCT_LIST
                        && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getComparison() === Criteria::IN
                        && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getValue() === $json
                ),
            )->willReturn($this->queryJoinCollectionTransferMock);

        static::assertEquals(
            $this->queryJoinCollectionTransferMock,
            $this->searchProductListQueryExpander->expand(
                $this->filterFieldTransferMocks,
                $this->queryJoinCollectionTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutProductListIds(): void
    {
        $json = json_encode([-1]);

        $this->productListReaderMock->expects(static::atLeastOnce())
            ->method('getIdsByFilterFields')
            ->with($this->filterFieldTransferMocks)
            ->willReturn([]);

        $this->utilEncodingServiceMock->expects(static::atLeastOnce())
            ->method('encodeJson')
            ->with([-1], null, null)
            ->willReturn($json);

        $this->queryJoinCollectionTransferMock->expects(static::atLeastOnce())
            ->method('addQueryJoin')
            ->with(
                static::callback(
                    fn (
                        QueryJoinTransfer $queryJoinTransfer
                    ) => $queryJoinTransfer->getWhereConditions()->count() === 1
                        && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getColumn() === SpyProductListTableMap::COL_ID_PRODUCT_LIST
                        && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getComparison() === Criteria::IN
                        && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getValue() === $json
                ),
            )->willReturn($this->queryJoinCollectionTransferMock);

        static::assertEquals(
            $this->queryJoinCollectionTransferMock,
            $this->searchProductListQueryExpander->expand(
                $this->filterFieldTransferMocks,
                $this->queryJoinCollectionTransferMock,
            ),
        );
    }
}
