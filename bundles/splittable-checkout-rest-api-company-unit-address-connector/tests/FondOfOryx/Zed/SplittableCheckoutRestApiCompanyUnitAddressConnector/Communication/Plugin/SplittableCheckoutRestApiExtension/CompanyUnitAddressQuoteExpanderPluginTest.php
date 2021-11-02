<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Communication\Plugin\SplittableCheckoutRestApiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Business\SplittableCheckoutRestApiCompanyUnitAddressConnectorFacade;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;

class CompanyUnitAddressQuoteExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Business\SplittableCheckoutRestApiCompanyUnitAddressConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
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
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Communication\Plugin\SplittableCheckoutRestApiExtension\CompanyUnitAddressQuoteExpanderPlugin
     */
    protected $companyUnitAddressQuoteExpanderPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(SplittableCheckoutRestApiCompanyUnitAddressConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutRequestTransferMock = $this->getMockBuilder(RestSplittableCheckoutRequestTransfer::class)
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
                $this->restSplittableCheckoutRequestTransferMock,
                $this->quoteTransferMock,
            )->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->companyUnitAddressQuoteExpanderPlugin->expand(
                $this->restSplittableCheckoutRequestTransferMock,
                $this->quoteTransferMock,
            ),
        );
    }
}
