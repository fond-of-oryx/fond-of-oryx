<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Communication\Plugin\SplittableTotalsRestApiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\SplittableTotalsRestApiCompanyUnitAddressConnectorFacade;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableTotalsRequestTransfer;

class CompanyUnitAddressQuoteExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\SplittableTotalsRestApiCompanyUnitAddressConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\SplittableTotalsRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Communication\Plugin\SplittableTotalsRestApiExtension\CompanyUnitAddressQuoteExpanderPlugin
     */
    protected $companyUnitAddressQuoteExpanderPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(SplittableTotalsRestApiCompanyUnitAddressConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsRequestTransferMock = $this->getMockBuilder(SplittableTotalsRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressQuoteExpanderPlugin = new CompanyUnitAddressQuoteExpanderPlugin();
        $this->companyUnitAddressQuoteExpanderPlugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExpandQuote(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('expandQuote')
            ->with(
                $this->splittableTotalsRequestTransferMock,
                $this->quoteTransferMock
            )->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->companyUnitAddressQuoteExpanderPlugin->expandQuote(
                $this->splittableTotalsRequestTransferMock,
                $this->quoteTransferMock
            )
        );
    }
}
