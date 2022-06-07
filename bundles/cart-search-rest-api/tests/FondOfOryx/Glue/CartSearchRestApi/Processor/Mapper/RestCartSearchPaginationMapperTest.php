<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig;
use Generated\Shared\Transfer\PaginationTransfer;
use Generated\Shared\Transfer\QuoteListTransfer;

class RestCartSearchPaginationMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $quoteListTransferMock;

    /**
     * @var \Generated\Shared\Transfer\PaginationTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $paginationTransferMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchPaginationMapper
     */
    protected $restCartSearchPaginationMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(CartSearchRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteListTransferMock = $this->getMockBuilder(QuoteListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paginationTransferMock = $this->getMockBuilder(PaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCartSearchPaginationMapper = new RestCartSearchPaginationMapper($this->configMock);
    }

    /**
     * @return void
     */
    public function testFromQuoteList(): void
    {
        $page = 1;
        $maxPerPage = 12;
        $nbResults = 23;
        $lastPage = 2;
        $itemsPerPage = 24;
        $validItemsPerPageOptions = [12, 24, 36];

        $this->quoteListTransferMock->expects(static::atLeastOnce())
            ->method('getPagination')
            ->willReturn($this->paginationTransferMock);

        $this->paginationTransferMock->expects(static::atLeastOnce())
            ->method('getPage')
            ->willReturn($page);

        $this->paginationTransferMock->expects(static::atLeastOnce())
            ->method('getLastPage')
            ->willReturn($lastPage);

        $this->paginationTransferMock->expects(static::atLeastOnce())
            ->method('getMaxPerPage')
            ->willReturn($maxPerPage);

        $this->paginationTransferMock->expects(static::atLeastOnce())
            ->method('getNbResults')
            ->willReturn($nbResults);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getItemsPerPage')
            ->willReturn($itemsPerPage);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getValidItemsPerPageOptions')
            ->willReturn($validItemsPerPageOptions);

        $this->restCartSearchPaginationMapper->fromQuoteList(
            $this->quoteListTransferMock,
        );
    }

    /**
     * @return void
     */
    public function testFromQuoteListWithNullablePagination(): void
    {
        $this->quoteListTransferMock->expects(static::atLeastOnce())
            ->method('getPagination')
            ->willReturn(null);

        $this->configMock->expects(static::never())
            ->method('getItemsPerPage');

        $this->configMock->expects(static::never())
            ->method('getValidItemsPerPageOptions');

        $this->restCartSearchPaginationMapper->fromQuoteList(
            $this->quoteListTransferMock,
        );
    }
}
