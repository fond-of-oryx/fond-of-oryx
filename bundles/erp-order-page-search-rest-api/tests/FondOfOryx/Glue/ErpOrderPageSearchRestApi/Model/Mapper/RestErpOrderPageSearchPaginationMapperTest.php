<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\PaginationSearchResultTransfer;

class RestErpOrderPageSearchPaginationMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\SortSearchResultTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $paginationSearchResultTransferMock;

    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchPaginationMapper
     */
    protected $restErpOrderPageSearchPaginationMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->paginationSearchResultTransferMock = $this->getMockBuilder(PaginationSearchResultTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpOrderPageSearchPaginationMapper = new RestErpOrderPageSearchPaginationMapper();
    }

    /**
     * @return void
     */
    public function testFromSearchResult(): void
    {
        $paginationData = [
            'num_found' => 0,
        ];

        $searchResult = [
            'pagination' => $this->paginationSearchResultTransferMock,
        ];

        $this->paginationSearchResultTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn($paginationData);

        $restErpOrderPageSearchPaginationTransfer = $this->restErpOrderPageSearchPaginationMapper->fromSearchResult(
            $searchResult,
        );

        static::assertEquals(
            $paginationData['num_found'],
            $restErpOrderPageSearchPaginationTransfer->getNumFound(),
        );
    }

    /**
     * @return void
     */
    public function testFromSearchResultWithoutPaginationData(): void
    {
        $searchResult = [];

        $this->paginationSearchResultTransferMock->expects(static::never())
            ->method('toArray');

        $restErpOrderPageSearchPaginationTransfer = $this->restErpOrderPageSearchPaginationMapper->fromSearchResult(
            $searchResult,
        );

        static::assertEquals(null, $restErpOrderPageSearchPaginationTransfer);
    }
}
