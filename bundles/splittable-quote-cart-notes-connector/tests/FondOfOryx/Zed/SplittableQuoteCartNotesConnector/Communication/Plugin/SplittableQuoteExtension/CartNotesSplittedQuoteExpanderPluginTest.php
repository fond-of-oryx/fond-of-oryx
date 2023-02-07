<?php

namespace FondOfOryx\Zed\SplittableQuoteCartNotesConnector\Communication\Plugin\SplittableQuoteExtension;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteTransfer;

class CartNotesSplittedQuoteExpanderPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableQuoteOrderCustomReferencesConnector\Communication\Plugin\SplittableQuoteExtension\OrderCustomReferencesSplittedQuoteExpanderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CartNotesSplittedQuoteExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $splitKey = 'foo';
        $cartNotes = [
            'foo' => 'bar',
            'bar' => 'foo',
        ];

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getSplitKey')
            ->willReturn($splitKey);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCartNotes')
            ->willReturn($cartNotes);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setCartNote')
            ->with($cartNotes[$splitKey])
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->plugin->expand($this->quoteTransferMock),
        );
    }
}
