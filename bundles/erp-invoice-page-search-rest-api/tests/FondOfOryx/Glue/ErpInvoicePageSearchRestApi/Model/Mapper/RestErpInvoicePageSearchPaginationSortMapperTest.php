<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\SortSearchResultTransfer;

class RestErpInvoicePageSearchPaginationSortMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\SortSearchResultTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $sortSearchResultTransferMock;

    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchPaginationSortMapper
     */
    protected $restErpInvoicePageSearchPaginationSortMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->sortSearchResultTransferMock = $this->getMockBuilder(SortSearchResultTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpInvoicePageSearchPaginationSortMapper = new RestErpInvoicePageSearchPaginationSortMapper();
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

        $restErpInvoicePageSearchPaginationSortTransfer = $this->restErpInvoicePageSearchPaginationSortMapper->fromSearchResult(
            $searchResult,
        );

        static::assertEquals(
            $paginationData['current_sort_order'],
            $restErpInvoicePageSearchPaginationSortTransfer->getCurrentSortOrder(),
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

        $restErpInvoicePageSearchPaginationTransfer = $this->restErpInvoicePageSearchPaginationSortMapper->fromSearchResult(
            $searchResult,
        );

        static::assertEquals(null, $restErpInvoicePageSearchPaginationTransfer);
    }
}
