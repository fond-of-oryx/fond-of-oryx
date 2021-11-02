<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Communication\Plugin\SplittableCheckoutRestApiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Business\SplittableCheckoutRestApiCustomerConnectorFacade;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;

class CustomerQuoteExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Business\SplittableCheckoutRestApiCustomerConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
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
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Communication\Plugin\SplittableCheckoutRestApiExtension\CustomerQuoteExpanderPlugin
     */
    protected $customerQuoteExpanderPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(SplittableCheckoutRestApiCustomerConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutRequestTransferMock = $this->getMockBuilder(RestSplittableCheckoutRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerQuoteExpanderPlugin = new CustomerQuoteExpanderPlugin();
        $this->customerQuoteExpanderPlugin->setFacade($this->facadeMock);
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
            $this->customerQuoteExpanderPlugin->expand(
                $this->restSplittableCheckoutRequestTransferMock,
                $this->quoteTransferMock,
            ),
        );
    }
}
