<?php

namespace FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business\Processor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeInterface;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerRegistrationResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;

class RegistrationProcessorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\SaveOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $saveOrderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationResponseTransferMock;

    /**
     * @var string
     */
    protected $mail = 'foo@bar.de';

    /**
     * @var bool
     */
    protected $subscribe = false;

    /**
     * @var string
     */
    protected $registrationKey = 'werghadgs234qwefqwaefqafq3456';

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business\Processor\RegistrationProcessorInterface
     */
    protected $processor;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->customerRegistrationFacadeMock = $this->getMockBuilder(CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->saveOrderTransferMock = $this->getMockBuilder(SaveOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationResponseTransferMock = $this->getMockBuilder(CustomerRegistrationResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->processor = new RegistrationProcessor(
            $this->customerRegistrationFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testProcessRegistration(): void
    {
        $self = $this;

        $this->quoteTransferMock->expects(static::atLeastOnce())->method('getCreateAccount')->willReturn(true);
        $this->quoteTransferMock->expects(static::atLeastOnce())->method('getAcceptTerms')->willReturn(true);
        $this->quoteTransferMock->expects(static::atLeastOnce())->method('getCustomer')->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())->method('getEmail')->willReturn($this->mail);
        $this->quoteTransferMock->expects(static::atLeastOnce())->method('getSignupNewsletter')->willReturn($this->subscribe);
        $this->customerTransferMock->expects(static::atLeastOnce())->method('getRegistrationKey')->willReturn($this->registrationKey);

        $this->customerRegistrationFacadeMock->expects(static::atLeastOnce())->method('customerRegistration')->willReturnCallback(static function (CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer) use ($self) {
            $attributes = $customerRegistrationRequestTransfer->getAttributes();
            static::assertSame($self->mail, $attributes->getEmail());
            static::assertSame($self->subscribe, $attributes->getSubscribe());
            static::assertSame($self->registrationKey, $attributes->getToken());

            return $self->customerRegistrationResponseTransferMock;
        });

        $this->processor->processRegistration(
            $this->saveOrderTransferMock,
            $this->quoteTransferMock,
        );
    }
}
