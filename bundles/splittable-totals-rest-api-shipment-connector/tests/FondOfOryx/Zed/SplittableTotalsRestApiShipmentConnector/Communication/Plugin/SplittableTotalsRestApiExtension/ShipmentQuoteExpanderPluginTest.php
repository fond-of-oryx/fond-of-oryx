<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Communication\Plugin\SplittableTotalsRestApiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business\SplittableTotalsRestApiShipmentConnectorFacade;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;

class ShipmentQuoteExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business\SplittableTotalsRestApiShipmentConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Communication\Plugin\SplittableTotalsRestApiExtension\ShipmentQuoteExpanderPlugin
     */
    protected $shipmentQuoteExpanderPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(SplittableTotalsRestApiShipmentConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsRequestTransferMock = $this->getMockBuilder(RestSplittableTotalsRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentQuoteExpanderPlugin = new ShipmentQuoteExpanderPlugin();
        $this->shipmentQuoteExpanderPlugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExpandQuote(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('expandQuote')
            ->with(
                $this->restSplittableTotalsRequestTransferMock,
                $this->quoteTransferMock
            )->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->shipmentQuoteExpanderPlugin->expand(
                $this->restSplittableTotalsRequestTransferMock,
                $this->quoteTransferMock
            )
        );
    }
}
