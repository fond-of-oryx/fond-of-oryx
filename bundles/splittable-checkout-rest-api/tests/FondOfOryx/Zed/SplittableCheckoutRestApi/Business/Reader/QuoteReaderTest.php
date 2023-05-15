<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Expander\QuoteExpanderInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCartFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToQuoteFacadeInterface;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class QuoteReaderTest extends Unit
{
    /**
     * @var (\Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestSplittableCheckoutRequestTransfer|MockObject $restSplittableCheckoutRequestTransferMock;

    /**
     * @var (\FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Expander\QuoteExpanderInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|QuoteExpanderInterface $quoteExpanderMock;

    /**
     * @var (\FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCartFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|SplittableCheckoutRestApiToCartFacadeInterface $cartFacadeMock;

    /**
     * @var (\FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToQuoteFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|SplittableCheckoutRestApiToQuoteFacadeInterface $quoteFacadeMock;

    /**
     * @var (\Generated\Shared\Transfer\QuoteResponseTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected QuoteResponseTransfer|MockObject $quoteResponseTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\QuoteTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected QuoteTransfer|MockObject $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader\QuoteReader
     */
    protected QuoteReader $quoteReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restSplittableCheckoutRequestTransferMock = $this->getMockBuilder(RestSplittableCheckoutRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteExpanderMock = $this->getMockBuilder(QuoteExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartFacadeMock = $this->getMockBuilder(SplittableCheckoutRestApiToCartFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteFacadeMock = $this->getMockBuilder(SplittableCheckoutRestApiToQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteResponseTransferMock = $this->getMockBuilder(QuoteResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteReader = new QuoteReader(
            $this->quoteExpanderMock,
            $this->cartFacadeMock,
            $this->quoteFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetByRestSplittableCheckoutRequest(): void
    {
        $uuid = 'a8f3d230-e76f-4e13-8b2d-19cd1ce263db';
        $customerReference = 'FOO-1';

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCart')
            ->willReturn($uuid);

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->quoteFacadeMock->expects(static::atLeastOnce())
            ->method('findQuoteByUuid')
            ->with(
                static::callback(
                    static function (QuoteTransfer $quoteTransfer) use ($uuid) {
                        return $quoteTransfer->getUuid() === $uuid;
                    },
                ),
            )->willReturn($this->quoteResponseTransferMock);

        $this->quoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getQuoteTransfer')
            ->willReturn($this->quoteTransferMock);

        $this->quoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->cartFacadeMock->expects(static::atLeastOnce())
            ->method('validateQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteResponseTransferMock);

        $this->quoteExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restSplittableCheckoutRequestTransferMock, $this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteReader->getByRestSplittableCheckoutRequest($this->restSplittableCheckoutRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetByRestSplittableCheckoutRequestWithoutIdCart(): void
    {
        $uuid = null;
        $customerReference = 'FOO-1';

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCart')
            ->willReturn($uuid);

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->quoteFacadeMock->expects(static::never())
            ->method('findQuoteByUuid');

        $this->cartFacadeMock->expects(static::never())
            ->method('validateQuote');

        $this->quoteExpanderMock->expects(static::never())
            ->method('expand');

        static::assertEquals(
            null,
            $this->quoteReader->getByRestSplittableCheckoutRequest($this->restSplittableCheckoutRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetByRestSplittableCheckoutRequestWithNonExistingQuote(): void
    {
        $uuid = 'a8f3d230-e76f-4e13-8b2d-19cd1ce263db';
        $customerReference = 'FOO-1';

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCart')
            ->willReturn($uuid);

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->quoteFacadeMock->expects(static::atLeastOnce())
            ->method('findQuoteByUuid')
            ->with(
                static::callback(
                    static function (QuoteTransfer $quoteTransfer) use ($uuid) {
                        return $quoteTransfer->getUuid() === $uuid;
                    },
                ),
            )->willReturn($this->quoteResponseTransferMock);

        $this->quoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getQuoteTransfer')
            ->willReturn(null);

        $this->quoteResponseTransferMock->expects(static::never())
            ->method('getIsSuccessful');

        $this->cartFacadeMock->expects(static::never())
            ->method('validateQuote');

        $this->quoteExpanderMock->expects(static::never())
            ->method('expand');

        static::assertEquals(
            null,
            $this->quoteReader->getByRestSplittableCheckoutRequest($this->restSplittableCheckoutRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetByRestSplittableCheckoutRequestWithoutPermission(): void
    {
        $uuid = 'a8f3d230-e76f-4e13-8b2d-19cd1ce263db';
        $customerReference = 'FOO-1';

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCart')
            ->willReturn($uuid);

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->quoteFacadeMock->expects(static::atLeastOnce())
            ->method('findQuoteByUuid')
            ->with(
                static::callback(
                    static function (QuoteTransfer $quoteTransfer) use ($uuid) {
                        return $quoteTransfer->getUuid() === $uuid;
                    },
                ),
            )->willReturn($this->quoteResponseTransferMock);

        $this->quoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getQuoteTransfer')
            ->willReturn($this->quoteTransferMock);

        $this->quoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn('FOO-7');

        $this->cartFacadeMock->expects(static::never())
            ->method('validateQuote');

        $this->quoteExpanderMock->expects(static::never())
            ->method('expand');

        static::assertEquals(
            null,
            $this->quoteReader->getByRestSplittableCheckoutRequest($this->restSplittableCheckoutRequestTransferMock),
        );
    }
}
