<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApiCartNotesConnector\Plugin\SplittableCheckoutRestApiExtension;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutTransfer;
use Generated\Shared\Transfer\SplittableCheckoutTransfer;

class CartNotesRestSplittableCheckoutExpanderPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\SplittableCheckoutTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableCheckoutTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutTransferMock;

    /**
     * @var array<string, \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $quoteTransferMocks;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApiCartNotesConnector\Plugin\SplittableCheckoutRestApiExtension\CartNotesRestSplittableCheckoutExpanderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->splittableCheckoutTransferMock = $this->getMockBuilder(SplittableCheckoutTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutTransferMock = $this->getMockBuilder(RestSplittableCheckoutTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMocks = [
            'foo' => $this->getMockBuilder(QuoteTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            'bar' => $this->getMockBuilder(QuoteTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->plugin = new CartNotesRestSplittableCheckoutExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $cartNotes = [
            'foo' => 'bar',
            'bar' => null,
        ];

        $this->splittableCheckoutTransferMock->expects(static::atLeastOnce())
            ->method('getSplittedQuotes')
            ->willReturn($this->quoteTransferMocks);

        foreach ($this->quoteTransferMocks as $key => $quoteTransferMock) {
            $quoteTransferMock->expects(static::atLeastOnce())
                ->method('getSplitKey')
                ->willReturn($key);

            $quoteTransferMock->expects(static::atLeastOnce())
                ->method('getCartNote')
                ->willReturn($cartNotes[$key]);
        }

        unset($cartNotes['bar']);

        $this->restSplittableCheckoutTransferMock->expects(static::atLeastOnce())
            ->method('setCartNotes')
            ->with($cartNotes)
            ->willReturn($this->restSplittableCheckoutTransferMock);

        static::assertEquals(
            $this->restSplittableCheckoutTransferMock,
            $this->plugin->expand($this->splittableCheckoutTransferMock, $this->restSplittableCheckoutTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutCartNotes(): void
    {
        $orderCustomReferences = [
            'foo' => null,
            'bar' => null,
        ];

        $this->splittableCheckoutTransferMock->expects(static::atLeastOnce())
            ->method('getSplittedQuotes')
            ->willReturn($this->quoteTransferMocks);

        foreach ($this->quoteTransferMocks as $key => $quoteTransferMock) {
            $quoteTransferMock->expects(static::atLeastOnce())
                ->method('getSplitKey')
                ->willReturn($key);

            $quoteTransferMock->expects(static::atLeastOnce())
                ->method('getCartNote')
                ->willReturn($orderCustomReferences[$key]);
        }

        $this->restSplittableCheckoutTransferMock->expects(static::never())
            ->method('setCartNotes');

        static::assertEquals(
            $this->restSplittableCheckoutTransferMock,
            $this->plugin->expand($this->splittableCheckoutTransferMock, $this->restSplittableCheckoutTransferMock),
        );
    }
}
