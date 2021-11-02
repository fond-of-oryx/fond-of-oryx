<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCartNoteConnector\Business\Expander;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CartNoteTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;

class QuoteExpanderTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CartNoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $cartNoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiCartNoteConnector\Business\Expander\QuoteExpander
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

        $this->cartNoteTransferMock = $this->getMockBuilder(CartNoteTransfer::class)
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
        $cartNote = 'Cart Note';

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCartNote')
            ->willReturn($this->cartNoteTransferMock);

        $this->cartNoteTransferMock->expects(static::atLeastOnce())
            ->method('getMessage')
            ->willReturn($cartNote);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setCartNote')
            ->willReturn($this->quoteTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCartNote')
            ->willReturn($cartNote);

        $quoteTransfer = $this->quoteExpander
            ->expand($this->restSplittableCheckoutRequestTransferMock, $this->quoteTransferMock);

        static::assertEquals($this->quoteTransferMock, $quoteTransfer);
        static::assertEquals($cartNote, $quoteTransfer->getCartNote());
    }

    /**
     * @return void
     */
    public function testExpandWithoutCartNote(): void
    {
        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCartNote')
            ->willReturn(null);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->restSplittableCheckoutRequestTransferMock, $this->quoteTransferMock),
        );
    }
}
