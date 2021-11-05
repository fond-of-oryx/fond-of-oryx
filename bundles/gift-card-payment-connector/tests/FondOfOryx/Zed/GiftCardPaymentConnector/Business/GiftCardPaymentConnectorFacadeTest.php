<?php

namespace FondOfOryx\Zed\GiftCardPaymentConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardPaymentConnector\Business\PaymentMethodFilter\GiftCardPaymentConnectorPaymentMethodFilter;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class GiftCardPaymentConnectorFacadeTest extends Unit
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
     * @var \FondOfOryx\Zed\GiftCardPaymentConnector\Business\GiftCardPaymentConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardPaymentConnector\Business\PaymentMethodFilter\GiftCardPaymentConnectorPaymentMethodFilter|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $GiftCardPaymentConnectorPaymentMethodFilterMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardPaymentConnector\Business\GiftCardPaymentConnectorFacade
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

        $this->businessFactoryMock = $this->getMockBuilder(GiftCardPaymentConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->GiftCardPaymentConnectorPaymentMethodFilterMock = $this->getMockBuilder(GiftCardPaymentConnectorPaymentMethodFilter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new GiftCardPaymentConnectorFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testFilterPaymentMethods(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createGiftCardPaymentConnectorPaymentMethod')
            ->willReturn($this->GiftCardPaymentConnectorPaymentMethodFilterMock);

        $this->GiftCardPaymentConnectorPaymentMethodFilterMock->expects(static::atLeastOnce())
            ->method('filterPaymentMethods')
            ->with($this->paymentMethodsTransferMock, $this->quoteTransferMock)
            ->willReturn($this->paymentMethodsTransferMock);

        $paymentMethodsTransfer = $this->facade->filterPaymentMethods($this->paymentMethodsTransferMock, $this->quoteTransferMock);

        static::assertEquals($this->paymentMethodsTransferMock, $paymentMethodsTransfer);
    }
}
