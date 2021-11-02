<?php

namespace FondOfOryx\Zed\SplittableQuoteShipmentConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableQuoteShipmentConnector\Business\Expander\SplittedQuoteExpanderInterface;
use Generated\Shared\Transfer\QuoteTransfer;

class SplittableQuoteShipmentConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableQuoteShipmentConnector\Business\SplittableQuoteShipmentConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\SplittableQuoteShipmentConnector\Business\Expander\SplittedQuoteExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittedQuoteExpanderMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableQuoteShipmentConnector\Business\SplittableQuoteShipmentConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(SplittableQuoteShipmentConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittedQuoteExpanderMock = $this->getMockBuilder(SplittedQuoteExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new SplittableQuoteShipmentConnectorFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testSplittedExpandQuote(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createSplittedQuoteExpander')
            ->willReturn($this->splittedQuoteExpanderMock);

        $this->splittedQuoteExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->facade->expandSplittedQuote($this->quoteTransferMock),
        );
    }
}
