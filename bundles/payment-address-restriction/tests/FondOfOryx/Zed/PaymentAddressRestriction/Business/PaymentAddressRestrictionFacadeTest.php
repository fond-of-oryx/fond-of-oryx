<?php

namespace FondOfOryx\Zed\PaymentAddressRestriction\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentMethodFilter\CountryRestrictionRestrictionPaymentMethodFilter;
use FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentMethodFilter\IdenticalAddressRestrictionPaymentMethodFilter;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class PaymentAddressRestrictionFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PaymentMethodsTransfer
     */
    protected $paymentMethodsTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentAddressRestrictionBusinessFactory
     */
    protected $businessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentMethodFilter\CountryRestrictionRestrictionPaymentMethodFilter
     */
    protected $countryRestrictionPaymentMethodFilterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentMethodFilter\IdenticalAddressRestrictionPaymentMethodFilter
     */
    protected $identicalAddressRestrictionPaymentMethodFilterMock;

    /**
     * @var \FondOfOryx\Zed\PaymentAddressRestriction\Business\PaymentAddressRestrictionFacade
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

        $this->countryRestrictionPaymentMethodFilterMock = $this->getMockBuilder(CountryRestrictionRestrictionPaymentMethodFilter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->identicalAddressRestrictionPaymentMethodFilterMock = $this->getMockBuilder(IdenticalAddressRestrictionPaymentMethodFilter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactoryMock = $this->getMockBuilder(PaymentAddressRestrictionBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentMethodsTransferMock = $this->getMockBuilder(PaymentMethodsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new PaymentAddressRestrictionFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testCountryRestrictionPaymentMethodFilter(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createCountryRestrictionPaymentMethodFilter')
            ->willReturn($this->countryRestrictionPaymentMethodFilterMock);

        $this->countryRestrictionPaymentMethodFilterMock->expects(static::atLeastOnce())
            ->method('filterPaymentMethods')
            ->with($this->paymentMethodsTransferMock, $this->quoteTransferMock)
            ->willReturn($this->paymentMethodsTransferMock);

        static::assertEquals(
            $this->paymentMethodsTransferMock,
            $this->facade->countryRestrictionPaymentMethodFilter($this->paymentMethodsTransferMock, $this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testIdenticalAddressRestrictionPaymentMethodFilter(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createIdenticalAddressRestrictionPaymentMethodFilter')
            ->willReturn($this->countryRestrictionPaymentMethodFilterMock);

        $this->countryRestrictionPaymentMethodFilterMock->expects(static::atLeastOnce())
            ->method('filterPaymentMethods')
            ->with($this->paymentMethodsTransferMock, $this->quoteTransferMock)
            ->willReturn($this->paymentMethodsTransferMock);

        static::assertEquals(
            $this->paymentMethodsTransferMock,
            $this->facade->identicalAddressRestrictionPaymentMethodFilter($this->paymentMethodsTransferMock, $this->quoteTransferMock),
        );
    }
}
