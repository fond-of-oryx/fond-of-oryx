<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestAddressTransfer;
use Generated\Shared\Transfer\RestTotalsTransfer;
use Generated\Shared\Transfer\SplittableCheckoutTransfer;

class RestSplittableCheckoutMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\SplittableCheckoutTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableCheckoutTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutMapper
     */
    protected $restSplittableCheckoutMapper;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestTotalsMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restTotalsMapperMock;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestAddressMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restAddressMapperMock;

    /**
     * @var \Generated\Shared\Transfer\RestTotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restTotalsTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restAddressTransferMock;

    /**
     * @var \Generated\Shared\Transfer\AddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $addressTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->splittableCheckoutTransferMock = $this->getMockBuilder(SplittableCheckoutTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->addressTransferMock = $this->getMockBuilder(AddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restTotalsTransferMock = $this->getMockBuilder(RestTotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restAddressTransferMock = $this->getMockBuilder(RestAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restTotalsMapperMock = $this->getMockBuilder(RestTotalsMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restAddressMapperMock = $this->getMockBuilder(RestAddressMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutMapper = new RestSplittableCheckoutMapper(
            $this->restTotalsMapperMock,
            $this->restAddressMapperMock,
        );
    }

    /**
     * @return void
     */
    public function testFromSplittableCheckout(): void
    {
        $orderReference = 'FOO1';
        $splittedQuoteTransfer = new ArrayObject(['*' => $this->quoteTransferMock]);

        $this->splittableCheckoutTransferMock->expects(static::atLeastOnce())
            ->method('getSplittedQuotes')
            ->willReturn($splittedQuoteTransfer);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getOrderReference')
            ->willReturn($orderReference);

        $this->restTotalsMapperMock->expects(static::atLeastOnce())
            ->method('fromQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->restTotalsTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn($this->addressTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->addressTransferMock);

        $this->restAddressMapperMock->expects(static::atLeastOnce())
            ->method('fromAddress')
            ->with($this->addressTransferMock)
            ->willReturn($this->restAddressTransferMock);

        $restSplittableCheckoutTransfer = $this->restSplittableCheckoutMapper
            ->fromSplittableCheckout($this->splittableCheckoutTransferMock);

        static::assertCount(1, $restSplittableCheckoutTransfer->getSplitKeys());
        static::assertEquals('*', $restSplittableCheckoutTransfer->getSplitKeys()[0]);
        static::assertCount(1, $restSplittableCheckoutTransfer->getTotalsList());
        static::assertEquals($this->restTotalsTransferMock, $restSplittableCheckoutTransfer->getTotalsList()[0]);
        static::assertCount(1, $restSplittableCheckoutTransfer->getOrderReferences());
        static::assertEquals($orderReference, $restSplittableCheckoutTransfer->getOrderReferences()[0]);
    }
}
