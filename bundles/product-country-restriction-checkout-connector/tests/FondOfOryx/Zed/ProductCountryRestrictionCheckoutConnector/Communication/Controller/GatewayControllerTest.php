<?php

namespace FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\ProductCountryRestrictionCheckoutConnectorFacade;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\ProductCountryRestrictionCheckoutConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteValidationResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteValidationResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Communication\Controller\GatewayController
     */
    protected $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(ProductCountryRestrictionCheckoutConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteValidationResponseTransferMock = $this->getMockBuilder(QuoteValidationResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new class ($this->facadeMock) extends GatewayController {
            /**
             * @param \Spryker\Zed\Kernel\Business\AbstractFacade $facade
             */
            public function __construct(AbstractFacade $facade)
            {
                $this->facade = $facade;
            }
        };
    }

    /**
     * @return void
     */
    public function testValidateQuoteAction(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('validateQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteValidationResponseTransferMock);

        static::assertEquals(
            $this->quoteValidationResponseTransferMock,
            $this->gatewayController->validateQuoteAction($this->quoteTransferMock)
        );
    }
}
