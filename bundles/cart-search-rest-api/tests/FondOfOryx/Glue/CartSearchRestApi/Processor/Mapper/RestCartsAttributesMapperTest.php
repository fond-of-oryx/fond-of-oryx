<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\CurrencyTransfer;
use Generated\Shared\Transfer\QuoteListTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestCartsDiscountsTransfer;
use Generated\Shared\Transfer\RestCartsTotalsTransfer;
use Generated\Shared\Transfer\StoreTransfer;

class RestCartsAttributesMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartsDiscountsMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCartsDiscountsMapperMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartsTotalsMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCartsTotalsMapperMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteListTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\StoreTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CurrencyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $currencyTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCartsDiscountsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCartsDiscountsTransferMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartsAttributesMapper
     */
    protected $restCartsAttributesMapper;

    /**
     * @var \Generated\Shared\Transfer\RestCartsTotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCartsTotalsTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restCartsDiscountsMapperMock = $this->getMockBuilder(RestCartsDiscountsMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCartsTotalsMapperMock = $this->getMockBuilder(RestCartsTotalsMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteListTransferMock = $this->getMockBuilder(QuoteListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->currencyTransferMock = $this->getMockBuilder(CurrencyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCartsDiscountsTransferMock = $this->getMockBuilder(RestCartsDiscountsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCartsTotalsTransferMock = $this->getMockBuilder(RestCartsTotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCartsAttributesMapper = new RestCartsAttributesMapper(
            $this->restCartsDiscountsMapperMock,
            $this->restCartsTotalsMapperMock,
        );
    }

    /**
     * @return void
     */
    public function testFromQuoteList(): void
    {
        $data = [];
        $uuid = '48981b6c-d230-4400-8e2e-ba7fe0005e4e';
        $currencyCode = 'EUR';
        $storeName = 'FOO';
        $quoteTransferMocks = new ArrayObject([$this->quoteTransferMock]);
        $restCartsDiscountsTransferMocks = new ArrayObject([$this->restCartsDiscountsTransferMock]);

        $this->quoteListTransferMock->expects(static::atLeastOnce())
            ->method('getQuotes')
            ->willReturn($quoteTransferMocks);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn($uuid);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCurrency')
            ->willReturn($this->currencyTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getStore')
            ->willReturn($this->storeTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn($data);

        $this->restCartsDiscountsMapperMock->expects(static::atLeastOnce())
            ->method('fromQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($restCartsDiscountsTransferMocks);

        $this->restCartsTotalsMapperMock->expects(static::atLeastOnce())
            ->method('fromQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->restCartsTotalsTransferMock);

        $this->storeTransferMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn($storeName);

        $this->currencyTransferMock->expects(static::atLeastOnce())
            ->method('getCode')
            ->willReturn($currencyCode);

        $restCartsAttributesTransfers = $this->restCartsAttributesMapper->fromQuoteList($this->quoteListTransferMock);

        static::assertCount(1, $restCartsAttributesTransfers);

        $restCartsAttributesTransfer = $restCartsAttributesTransfers->offsetGet(0);

        static::assertEquals($restCartsDiscountsTransferMocks, $restCartsAttributesTransfer->getDiscounts());
        static::assertEquals($this->restCartsTotalsTransferMock, $restCartsAttributesTransfer->getTotals());
        static::assertEquals($storeName, $restCartsAttributesTransfer->getStore());
        static::assertEquals($currencyCode, $restCartsAttributesTransfer->getCurrency());
    }
}
