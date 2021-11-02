<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCartNoteConnector\Communication\Plugin\SplittableCheckoutRestApiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckoutRestApiCartNoteConnector\Business\SplittableCheckoutRestApiCartNoteConnectorFacade;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;

class CartNoteQuoteExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiCartNoteConnector\Business\SplittableCheckoutRestApiCartNoteConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiCartNoteConnector\Communication\Plugin\SplittableCheckoutRestApiExtension\CartNoteQuoteExpanderPlugin
     */
    protected $cartNoteQuoteExpanderPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(SplittableCheckoutRestApiCartNoteConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutRequestTransferMock = $this->getMockBuilder(RestSplittableCheckoutRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartNoteQuoteExpanderPlugin = new CartNoteQuoteExpanderPlugin();
        $this->cartNoteQuoteExpanderPlugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExpandQuote(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('expandQuote')
            ->with(
                $this->restSplittableCheckoutRequestTransferMock,
                $this->quoteTransferMock,
            )->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->cartNoteQuoteExpanderPlugin->expand(
                $this->restSplittableCheckoutRequestTransferMock,
                $this->quoteTransferMock,
            ),
        );
    }
}
