<?php

namespace FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector;

use Codeception\Test\Unit;
use FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector\Zed\ProductCountryRestrictionCheckoutConnectorStubInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;

class ProductCountryRestrictionCheckoutConnectorClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector\ProductCountryRestrictionCheckoutConnectorFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteValidationResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteValidationResponseTransferMock;

    /**
     * @var \FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector\Zed\ProductCountryRestrictionCheckoutConnectorStubInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productCountryRestrictionCheckoutConnectorZedStubMock;

    /**
     * @var \FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector\ProductCountryRestrictionCheckoutConnectorClient
     */
    protected $productCountryRestrictionCheckoutConnectorClient;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(ProductCountryRestrictionCheckoutConnectorFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteValidationResponseTransferMock = $this->getMockBuilder(QuoteValidationResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productCountryRestrictionCheckoutConnectorZedStubMock = $this->getMockBuilder(ProductCountryRestrictionCheckoutConnectorStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productCountryRestrictionCheckoutConnectorClient = new ProductCountryRestrictionCheckoutConnectorClient();
        $this->productCountryRestrictionCheckoutConnectorClient->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testValidateQuote(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProductCountryRestrictionCheckoutConnectorZedStub')
            ->willReturn($this->productCountryRestrictionCheckoutConnectorZedStubMock);

        $this->productCountryRestrictionCheckoutConnectorZedStubMock->expects(static::atLeastOnce())
            ->method('validateQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteValidationResponseTransferMock);

        static::assertEquals(
            $this->quoteValidationResponseTransferMock,
            $this->productCountryRestrictionCheckoutConnectorClient->validateQuote($this->quoteTransferMock),
        );
    }
}
