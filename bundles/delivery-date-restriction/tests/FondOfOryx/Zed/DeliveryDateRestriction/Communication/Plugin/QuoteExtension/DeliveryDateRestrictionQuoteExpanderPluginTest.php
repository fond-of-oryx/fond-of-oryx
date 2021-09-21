<?php

namespace FondOfOryx\Zed\DeliveryDateRestriction\Communication\Plugin\QuoteExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\DeliveryDateRestriction\Business\DeliveryDateRestrictionFacade;
use Generated\Shared\Transfer\QuoteTransfer;

class DeliveryDateRestrictionQuoteExpanderPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\DeliveryDateRestriction\Business\DeliveryDateRestrictionFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\DeliveryDateRestriction\Communication\Plugin\QuoteExtension\DeliveryDateRestrictionQuoteExpanderPlugin
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

        $this->facadeMock = $this->getMockBuilder(DeliveryDateRestrictionFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new DeliveryDateRestrictionQuoteExpanderPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('expandQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->plugin->expand($this->quoteTransferMock)
        );
    }
}
