<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiShipmentConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckoutRestApiShipmentConnector\Business\Expander\QuoteExpanderInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;

class SplittableCheckoutRestApiShipmentConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiShipmentConnector\Business\SplittableCheckoutRestApiShipmentConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiShipmentConnector\Business\Expander\QuoteExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteExpanderMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiShipmentConnector\Business\SplittableCheckoutRestApiShipmentConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(SplittableCheckoutRestApiShipmentConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteExpanderMock = $this->getMockBuilder(QuoteExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutRequestTransferMock = $this->getMockBuilder(RestSplittableCheckoutRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new SplittableCheckoutRestApiShipmentConnectorFacade();
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
            ->with($this->restSplittableCheckoutRequestTransferMock, $this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->facade->expandQuote(
                $this->restSplittableCheckoutRequestTransferMock,
                $this->quoteTransferMock,
            ),
        );
    }
}
