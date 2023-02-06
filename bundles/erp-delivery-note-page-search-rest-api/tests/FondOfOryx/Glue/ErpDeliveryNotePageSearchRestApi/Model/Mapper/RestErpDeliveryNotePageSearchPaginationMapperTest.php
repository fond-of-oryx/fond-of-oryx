<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\PaginationSearchResultTransfer;

class RestErpDeliveryNotePageSearchPaginationMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\SortSearchResultTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $paginationSearchResultTransferMock;

    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchPaginationMapper
     */
    protected $restErpDeliveryNotePageSearchPaginationMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->paginationSearchResultTransferMock = $this->getMockBuilder(PaginationSearchResultTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpDeliveryNotePageSearchPaginationMapper = new RestErpDeliveryNotePageSearchPaginationMapper();
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

        $restErpDeliveryNotePageSearchPaginationTransfer = $this->restErpDeliveryNotePageSearchPaginationMapper->fromSearchResult(
            $searchResult,
        );

        static::assertEquals(
            $paginationData['num_found'],
            $restErpDeliveryNotePageSearchPaginationTransfer->getNumFound(),
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

        $restErpDeliveryNotePageSearchPaginationTransfer = $this->restErpDeliveryNotePageSearchPaginationMapper->fromSearchResult(
            $searchResult,
        );

        static::assertEquals(null, $restErpDeliveryNotePageSearchPaginationTransfer);
    }
}
