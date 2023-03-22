<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\SortSearchResultTransfer;

class RestErpDeliveryNotePageSearchPaginationSortMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\SortSearchResultTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $sortSearchResultTransferMock;

    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchPaginationSortMapper
     */
    protected $restErpDeliveryNotePageSearchPaginationSortMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->sortSearchResultTransferMock = $this->getMockBuilder(SortSearchResultTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpDeliveryNotePageSearchPaginationSortMapper = new RestErpDeliveryNotePageSearchPaginationSortMapper();
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

        $restErpDeliveryNotePageSearchPaginationSortTransfer = $this->restErpDeliveryNotePageSearchPaginationSortMapper->fromSearchResult(
            $searchResult,
        );

        static::assertEquals(
            $paginationData['current_sort_order'],
            $restErpDeliveryNotePageSearchPaginationSortTransfer->getCurrentSortOrder(),
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

        $restErpDeliveryNotePageSearchPaginationTransfer = $this->restErpDeliveryNotePageSearchPaginationSortMapper->fromSearchResult(
            $searchResult,
        );

        static::assertEquals(null, $restErpDeliveryNotePageSearchPaginationTransfer);
    }
}
