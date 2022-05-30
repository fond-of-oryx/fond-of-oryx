<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Business\Reader;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\CartSearchRestApi\Persistence\CartSearchRestApiRepositoryInterface;
use FondOfOryx\Zed\CartSearchRestApiExtension\Dependency\Plugin\SearchQuoteQueryExpanderPluginInterface;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QuoteListTransfer;

class QuoteReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CartSearchRestApi\Persistence\CartSearchRestApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var array<\FondOfOryx\Zed\CartSearchRestApiExtension\Dependency\Plugin\SearchQuoteQueryExpanderPluginInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $searchQuoteQueryExpanderPluginMocks;

    /**
     * @var \Generated\Shared\Transfer\QuoteListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteListTransferMock;

    /**
     * @var \Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $filterFieldTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QueryJoinCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $queryJoinCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\CartSearchRestApi\Business\Reader\QuoteReader
     */
    protected $quoteReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CartSearchRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchQuoteQueryExpanderPluginMocks = [
            $this->getMockBuilder(SearchQuoteQueryExpanderPluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(SearchQuoteQueryExpanderPluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->quoteListTransferMock = $this->getMockBuilder(QuoteListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldTransferMock = $this->getMockBuilder(FilterFieldTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryJoinCollectionTransferMock = $this->getMockBuilder(QueryJoinCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteReader = new QuoteReader(
            $this->repositoryMock,
            $this->searchQuoteQueryExpanderPluginMocks,
        );
    }

    /**
     * @return void
     */
    public function testFindQuoteList(): void
    {
        $filterFieldTransferMocks = [
            $this->filterFieldTransferMock,
        ];

        $this->quoteListTransferMock->expects(static::atLeastOnce())
            ->method('getFilterFields')
            ->willReturn(new ArrayObject($filterFieldTransferMocks));

        $this->searchQuoteQueryExpanderPluginMocks[0]->expects(static::atLeastOnce())
            ->method('isApplicable')
            ->with($filterFieldTransferMocks)
            ->willReturn(true);

        $this->searchQuoteQueryExpanderPluginMocks[0]->expects(static::atLeastOnce())
            ->method('expand')
            ->with(
                $filterFieldTransferMocks,
                static::callback(
                    static function (QueryJoinCollectionTransfer $queryJoinCollectionTransfer) {
                        return $queryJoinCollectionTransfer->getQueryJoins()->count() === 0;
                    },
                ),
            )->willReturn($this->queryJoinCollectionTransferMock);

        $this->searchQuoteQueryExpanderPluginMocks[1]->expects(static::atLeastOnce())
            ->method('isApplicable')
            ->with($filterFieldTransferMocks)
            ->willReturn(false);

        $this->searchQuoteQueryExpanderPluginMocks[1]->expects(static::never())
            ->method('expand');

        $this->quoteListTransferMock->expects(static::atLeastOnce())
            ->method('setQueryJoins')
            ->with($this->queryJoinCollectionTransferMock)
            ->willReturn($this->quoteListTransferMock);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findQuotes')
            ->with($this->quoteListTransferMock)
            ->willReturn($this->quoteListTransferMock);

        static::assertEquals(
            $this->quoteListTransferMock,
            $this->quoteReader->findByQuoteList($this->quoteListTransferMock),
        );
    }
}
