<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiOrderCustomReferenceConnector\Business\Expander;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;

class QuoteExpanderTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiOrderCustomReferenceConnector\Business\Expander\QuoteExpander
     */
    protected $quoteExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restSplittableCheckoutRequestTransferMock = $this->getMockBuilder(RestSplittableCheckoutRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteExpander = new QuoteExpander();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $orderCustomReference = 'orderCustomReference';

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getOrderCustomReference')
            ->willReturn($orderCustomReference);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setOrderCustomReference')
            ->willReturn($this->quoteTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getOrderCustomReference')
            ->willReturn($orderCustomReference);

        $quoteTransfer = $this->quoteExpander
            ->expand($this->restSplittableCheckoutRequestTransferMock, $this->quoteTransferMock);

        static::assertEquals($this->quoteTransferMock, $quoteTransfer);
        static::assertEquals($orderCustomReference, $quoteTransfer->getOrderCustomReference());
    }

    /**
     * @return void
     */
    public function testExpandWithoutOrderCustomReference(): void
    {
        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getOrderCustomReference')
            ->willReturn(null);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->restSplittableCheckoutRequestTransferMock, $this->quoteTransferMock)
        );
    }
}
