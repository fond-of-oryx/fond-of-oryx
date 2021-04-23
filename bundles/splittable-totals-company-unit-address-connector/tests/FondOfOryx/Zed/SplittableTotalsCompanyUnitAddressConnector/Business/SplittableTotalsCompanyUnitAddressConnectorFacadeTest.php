<?php

namespace FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\Expander\QuoteExpanderInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableTotalsRequestTransfer;

class SplittableTotalsCompanyUnitAddressConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\Expander\QuoteExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteExpanderMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\SplittableTotalsCompanyUnitAddressConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\SplittableTotalsRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\SplittableTotalsCompanyUnitAddressConnectorFacade
     */
    protected $facade;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteExpanderMock = $this->getMockBuilder(QuoteExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactoryMock = $this->getMockBuilder(SplittableTotalsCompanyUnitAddressConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsRequestTransferMock = $this->getMockBuilder(SplittableTotalsRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new SplittableTotalsCompanyUnitAddressConnectorFacade();
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
            ->with($this->splittableTotalsRequestTransferMock, $this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->facade->expandQuote($this->splittableTotalsRequestTransferMock, $this->quoteTransferMock)
        );
    }
}
