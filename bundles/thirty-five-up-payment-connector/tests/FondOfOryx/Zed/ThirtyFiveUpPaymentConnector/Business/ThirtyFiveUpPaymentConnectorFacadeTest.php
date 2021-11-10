<?php

namespace FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\Business\PaymentMethodFilter\ThirtyFiveUpPaymentMethodFilter;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class ThirtyFiveUpPaymentConnectorFacadeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\PaymentMethodsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $paymentMethodsTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\Business\ThirtyFiveUpPaymentConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\Business\PaymentMethodFilter\ThirtyFiveUpPaymentMethodFilter|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpPaymentMethodFilterMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\Business\ThirtyFiveUpPaymentConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->paymentMethodsTransferMock = $this->getMockBuilder(PaymentMethodsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactoryMock = $this->getMockBuilder(ThirtyFiveUpPaymentConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->thirtyFiveUpPaymentMethodFilterMock = $this->getMockBuilder(ThirtyFiveUpPaymentMethodFilter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new ThirtyFiveUpPaymentConnectorFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testFilterPaymentMethods(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createThirtyFiveUpPaymentMethodFilter')
            ->willReturn($this->thirtyFiveUpPaymentMethodFilterMock);

        $this->thirtyFiveUpPaymentMethodFilterMock->expects(static::atLeastOnce())
            ->method('filterPaymentMethods')
            ->with($this->paymentMethodsTransferMock, $this->quoteTransferMock)
            ->willReturn($this->paymentMethodsTransferMock);

        $paymentMethodsTransfer = $this->facade->filterPaymentMethods($this->paymentMethodsTransferMock, $this->quoteTransferMock);

        static::assertEquals($this->paymentMethodsTransferMock, $paymentMethodsTransfer);
    }
}
