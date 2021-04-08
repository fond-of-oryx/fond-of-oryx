<?php

namespace FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\Model\QuoteValidatorInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;

class ProductCountryRestrictionCheckoutConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\ProductCountryRestrictionCheckoutConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\Model\QuoteValidatorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteValidatorMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteValidationResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteValidationResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\ProductCountryRestrictionCheckoutConnectorFacade
     */
    protected $productCountryRestrictionCheckoutConnectorFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(ProductCountryRestrictionCheckoutConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteValidatorMock = $this->getMockBuilder(QuoteValidatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteValidationResponseTransferMock = $this->getMockBuilder(QuoteValidationResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productCountryRestrictionCheckoutConnectorFacade = new ProductCountryRestrictionCheckoutConnectorFacade();
        $this->productCountryRestrictionCheckoutConnectorFacade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testValidateQuote(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createQuoteValidator')
            ->willReturn($this->quoteValidatorMock);

        $this->quoteValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteValidationResponseTransferMock);

        static::assertEquals(
            $this->quoteValidationResponseTransferMock,
            $this->productCountryRestrictionCheckoutConnectorFacade->validateQuote($this->quoteTransferMock)
        );
    }
}
