<?php

namespace FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector\Dependency\Client\ProductCountryRestrictionCheckoutConnectorToZedRequestClientInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;

class ProductCountryRestrictionCheckoutConnectorStubTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteValidationResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteValidationResponseTransferMock;

    /**
     * @var \FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector\Dependency\Client\ProductCountryRestrictionCheckoutConnectorToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector\Zed\ProductCountryRestrictionCheckoutConnectorStub
     */
    protected $productCountryRestrictionCheckoutConnectorStub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteValidationResponseTransferMock = $this->getMockBuilder(QuoteValidationResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(ProductCountryRestrictionCheckoutConnectorToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productCountryRestrictionCheckoutConnectorStub = new ProductCountryRestrictionCheckoutConnectorStub(
            $this->zedRequestClientMock,
        );
    }

    /**
     * @return void
     */
    public function testValidateQuote(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                '/product-country-restriction-checkout-connector/gateway/validate-quote',
                $this->quoteTransferMock,
            )->willReturn($this->quoteValidationResponseTransferMock);

        static::assertEquals(
            $this->quoteValidationResponseTransferMock,
            $this->productCountryRestrictionCheckoutConnectorStub->validateQuote($this->quoteTransferMock),
        );
    }
}
