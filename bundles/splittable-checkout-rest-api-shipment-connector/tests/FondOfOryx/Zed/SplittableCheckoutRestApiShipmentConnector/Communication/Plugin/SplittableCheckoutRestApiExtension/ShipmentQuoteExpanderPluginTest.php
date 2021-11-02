<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiShipmentConnector\Communication\Plugin\SplittableCheckoutRestApiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckoutRestApiShipmentConnector\Business\SplittableCheckoutRestApiShipmentConnectorFacade;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;

class ShipmentQuoteExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiShipmentConnector\Business\SplittableCheckoutRestApiShipmentConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
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
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiShipmentConnector\Communication\Plugin\SplittableCheckoutRestApiExtension\ShipmentQuoteExpanderPlugin
     */
    protected $shipmentQuoteExpanderPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(SplittableCheckoutRestApiShipmentConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutRequestTransferMock = $this->getMockBuilder(RestSplittableCheckoutRequestTransfer::class)
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
                $this->restSplittableCheckoutRequestTransferMock,
                $this->quoteTransferMock,
            )->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->shipmentQuoteExpanderPlugin->expand(
                $this->restSplittableCheckoutRequestTransferMock,
                $this->quoteTransferMock,
            ),
        );
    }
}
