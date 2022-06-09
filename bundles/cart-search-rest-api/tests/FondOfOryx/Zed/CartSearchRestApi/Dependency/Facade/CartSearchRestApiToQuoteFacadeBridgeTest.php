<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteCollectionTransfer;
use Generated\Shared\Transfer\QuoteCriteriaFilterTransfer;
use Spryker\Zed\Quote\Business\QuoteFacadeInterface;

class CartSearchRestApiToQuoteFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Quote\Business\QuoteFacadeInterface
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteCriteriaFilterTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteCriteriaFilterTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\CartSearchRestApi\Dependency\Facade\CartSearchRestApiToQuoteFacadeBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(QuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteCriteriaFilterTransferMock = $this->getMockBuilder(QuoteCriteriaFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteCollectionTransferMock = $this->getMockBuilder(QuoteCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new CartSearchRestApiToQuoteFacadeBridge(
            $this->facadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetQuoteCollection(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('getQuoteCollection')
            ->with($this->quoteCriteriaFilterTransferMock)
            ->willReturn($this->quoteCollectionTransferMock);

        static::assertEquals(
            $this->quoteCollectionTransferMock,
            $this->bridge->getQuoteCollection($this->quoteCriteriaFilterTransferMock),
        );
    }
}
