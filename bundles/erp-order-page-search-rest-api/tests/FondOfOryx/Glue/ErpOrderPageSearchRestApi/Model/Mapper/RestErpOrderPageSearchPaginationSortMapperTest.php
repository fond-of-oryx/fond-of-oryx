<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\SortSearchResultTransfer;

class RestErpOrderPageSearchPaginationSortMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\SortSearchResultTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $sortSearchResultTransferMock;

    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchPaginationSortMapper
     */
    protected $restErpOrderPageSearchPaginationSortMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->sortSearchResultTransferMock = $this->getMockBuilder(SortSearchResultTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpOrderPageSearchPaginationSortMapper = new RestErpOrderPageSearchPaginationSortMapper();
    }

    /**
     * @return void
     */
    public function testFromSearchResult(): void
    {
        $paginationData = [
            'current_sort_order' => 'asc',
        ];

        $searchResult = [
            'sort' => $this->sortSearchResultTransferMock,
        ];

        $this->sortSearchResultTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn($paginationData);

        $restErpOrderPageSearchPaginationSortTransfer = $this->restErpOrderPageSearchPaginationSortMapper->fromSearchResult(
            $searchResult,
        );

        static::assertEquals(
            $paginationData['current_sort_order'],
            $restErpOrderPageSearchPaginationSortTransfer->getCurrentSortOrder(),
        );
    }

    /**
     * @return void
     */
    public function testFromSearchResultWithoutPaginationData(): void
    {
        $searchResult = [];

        $this->sortSearchResultTransferMock->expects(static::never())
            ->method('toArray');

        $restErpOrderPageSearchPaginationTransfer = $this->restErpOrderPageSearchPaginationSortMapper->fromSearchResult(
            $searchResult,
        );

        static::assertEquals(null, $restErpOrderPageSearchPaginationTransfer);
    }
}
