<?php

namespace FondOfOryx\Zed\SplittableTotalsShipmentConnector\Communication\Plugin\SplittableTotalsExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotalsShipmentConnector\Business\SplittableTotalsShipmentConnectorFacade;
use Generated\Shared\Transfer\QuoteTransfer;

class ShipmentSplittedQuoteExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotalsShipmentConnector\Business\SplittableTotalsShipmentConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsShipmentConnector\Communication\Plugin\SplittableTotalsExtension\ShipmentSplittedQuoteExpanderPlugin
     */
    protected $shipmentSplittedQuoteExpanderPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(SplittableTotalsShipmentConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentSplittedQuoteExpanderPlugin = new ShipmentSplittedQuoteExpanderPlugin();
        $this->shipmentSplittedQuoteExpanderPlugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExpandQuote(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('expandSplittedQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->shipmentSplittedQuoteExpanderPlugin->expand($this->quoteTransferMock)
        );
    }
}
