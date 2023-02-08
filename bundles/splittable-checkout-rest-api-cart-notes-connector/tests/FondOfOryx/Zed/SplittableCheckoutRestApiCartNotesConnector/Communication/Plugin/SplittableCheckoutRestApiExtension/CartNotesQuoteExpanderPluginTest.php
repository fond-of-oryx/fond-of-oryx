<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCartNotesConnector\Communication\Plugin\SplittableCheckoutRestApiExtension;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;

class CartNotesQuoteExpanderPluginTest extends Unit
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
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiCartNotesConnector\Communication\Plugin\SplittableCheckoutRestApiExtension\CartNotesQuoteExpanderPlugin
     */
    protected $plugin;

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

        $this->plugin = new CartNotesQuoteExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpandQuote(): void
    {
        $cartNotes = [
            'foo' => 'bar',
            'bar' => 'foo',
        ];

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCartNotes')
            ->willReturn($cartNotes);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setCartNotes')
            ->with($cartNotes)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->plugin->expand(
                $this->restSplittableCheckoutRequestTransferMock,
                $this->quoteTransferMock,
            ),
        );
    }
}
