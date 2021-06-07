<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business\Expander\QuoteExpanderInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;

class SplittableTotalsRestApiShipmentConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business\SplittableTotalsRestApiShipmentConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business\Expander\QuoteExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteExpanderMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business\SplittableTotalsRestApiShipmentConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(SplittableTotalsRestApiShipmentConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteExpanderMock = $this->getMockBuilder(QuoteExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsRequestTransferMock = $this->getMockBuilder(RestSplittableTotalsRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new SplittableTotalsRestApiShipmentConnectorFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testExpandQuote(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createQuoteExpander')
            ->willReturn($this->quoteExpanderMock);

        $this->quoteExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restSplittableTotalsRequestTransferMock, $this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->facade->expandQuote(
                $this->restSplittableTotalsRequestTransferMock,
                $this->quoteTransferMock
            )
        );
    }
}
