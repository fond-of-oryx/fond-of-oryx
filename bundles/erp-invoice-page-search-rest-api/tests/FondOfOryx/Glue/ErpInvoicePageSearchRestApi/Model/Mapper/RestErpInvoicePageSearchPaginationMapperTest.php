<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\PaginationSearchResultTransfer;

class RestErpInvoicePageSearchPaginationMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\SortSearchResultTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $paginationSearchResultTransferMock;

    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchPaginationMapper
     */
    protected $restErpInvoicePageSearchPaginationMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->paginationSearchResultTransferMock = $this->getMockBuilder(PaginationSearchResultTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpInvoicePageSearchPaginationMapper = new RestErpInvoicePageSearchPaginationMapper();
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

        $restErpInvoicePageSearchPaginationTransfer = $this->restErpInvoicePageSearchPaginationMapper->fromSearchResult(
            $searchResult,
        );

        static::assertEquals(
            $paginationData['num_found'],
            $restErpInvoicePageSearchPaginationTransfer->getNumFound(),
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

        $restErpInvoicePageSearchPaginationTransfer = $this->restErpInvoicePageSearchPaginationMapper->fromSearchResult(
            $searchResult,
        );

        static::assertEquals(null, $restErpInvoicePageSearchPaginationTransfer);
    }
}
