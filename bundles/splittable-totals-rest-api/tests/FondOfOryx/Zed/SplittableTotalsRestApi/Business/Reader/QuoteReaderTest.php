<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApi\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotalsRestApi\Business\Expander\QuoteExpanderInterface;
use FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade\SplittableTotalsRestApiToQuoteFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;

class QuoteReaderTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApi\Business\Expander\QuoteExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteExpanderMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade\SplittableTotalsRestApiToQuoteFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApi\Business\Reader\QuoteReader
     */
    protected $quoteReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restSplittableTotalsRequestTransferMock = $this->getMockBuilder(RestSplittableTotalsRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteExpanderMock = $this->getMockBuilder(QuoteExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteFacadeMock = $this->getMockBuilder(SplittableTotalsRestApiToQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteResponseTransferMock = $this->getMockBuilder(QuoteResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteReader = new QuoteReader(
            $this->quoteExpanderMock,
            $this->quoteFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testGetByRestSplittableTotalsRequest(): void
    {
        $uuid = 'a8f3d230-e76f-4e13-8b2d-19cd1ce263db';
        $idCustomer = 1;

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCart')
            ->willReturn($uuid);

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->quoteFacadeMock->expects(static::atLeastOnce())
            ->method('findQuoteByUuid')
            ->with(
                static::callback(
                    static function (QuoteTransfer $quoteTransfer) use ($uuid) {
                        return $quoteTransfer->getUuid() === $uuid;
                    }
                )
            )->willReturn($this->quoteResponseTransferMock);

        $this->quoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getQuoteTransfer')
            ->willReturn($this->quoteTransferMock);

        $this->quoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->quoteExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restSplittableTotalsRequestTransferMock, $this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteReader->getByRestSplittableTotalsRequest($this->restSplittableTotalsRequestTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testGetByRestSplittableTotalsRequestWithoutIdCart(): void
    {
        $uuid = null;
        $idCustomer = 1;

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCart')
            ->willReturn($uuid);

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->quoteFacadeMock->expects(static::never())
            ->method('findQuoteByUuid');

        $this->quoteExpanderMock->expects(static::never())
            ->method('expand');

        static::assertEquals(
            null,
            $this->quoteReader->getByRestSplittableTotalsRequest($this->restSplittableTotalsRequestTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testGetByRestSplittableTotalsRequestWithNonExistingQuote(): void
    {
        $uuid = 'a8f3d230-e76f-4e13-8b2d-19cd1ce263db';
        $idCustomer = 1;

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCart')
            ->willReturn($uuid);

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->quoteFacadeMock->expects(static::atLeastOnce())
            ->method('findQuoteByUuid')
            ->with(
                static::callback(
                    static function (QuoteTransfer $quoteTransfer) use ($uuid) {
                        return $quoteTransfer->getUuid() === $uuid;
                    }
                )
            )->willReturn($this->quoteResponseTransferMock);

        $this->quoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getQuoteTransfer')
            ->willReturn(null);

        $this->quoteResponseTransferMock->expects(static::never())
            ->method('getIsSuccessful');

        $this->quoteExpanderMock->expects(static::never())
            ->method('expand');

        static::assertEquals(
            null,
            $this->quoteReader->getByRestSplittableTotalsRequest($this->restSplittableTotalsRequestTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testGetByRestSplittableTotalsRequestWithoutPermission(): void
    {
        $uuid = 'a8f3d230-e76f-4e13-8b2d-19cd1ce263db';
        $idCustomer = 1;

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCart')
            ->willReturn($uuid);

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->quoteFacadeMock->expects(static::atLeastOnce())
            ->method('findQuoteByUuid')
            ->with(
                static::callback(
                    static function (QuoteTransfer $quoteTransfer) use ($uuid) {
                        return $quoteTransfer->getUuid() === $uuid;
                    }
                )
            )->willReturn($this->quoteResponseTransferMock);

        $this->quoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getQuoteTransfer')
            ->willReturn($this->quoteTransferMock);

        $this->quoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn(3);

        $this->quoteExpanderMock->expects(static::never())
            ->method('expand');

        static::assertEquals(
            null,
            $this->quoteReader->getByRestSplittableTotalsRequest($this->restSplittableTotalsRequestTransferMock)
        );
    }
}
