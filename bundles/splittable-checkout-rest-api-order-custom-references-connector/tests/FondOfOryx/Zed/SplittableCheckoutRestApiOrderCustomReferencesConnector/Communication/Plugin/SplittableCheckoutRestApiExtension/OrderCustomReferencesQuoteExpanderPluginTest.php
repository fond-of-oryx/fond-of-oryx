<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiOrderCustomReferencesConnector\Communication\Plugin\SplittableCheckoutRestApiExtension;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;

class OrderCustomReferencesQuoteExpanderPluginTest extends Unit
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
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiOrderCustomReferencesConnector\Communication\Plugin\SplittableCheckoutRestApiExtension\OrderCustomReferencesQuoteExpanderPlugin
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

        $this->plugin = new OrderCustomReferencesQuoteExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpandQuote(): void
    {
        $orderCustomReferences = [
            'foo' => 'bar',
            'bar' => 'foo',
        ];

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getOrderCustomReferences')
            ->willReturn($orderCustomReferences);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setOrderCustomReferences')
            ->with($orderCustomReferences)
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
