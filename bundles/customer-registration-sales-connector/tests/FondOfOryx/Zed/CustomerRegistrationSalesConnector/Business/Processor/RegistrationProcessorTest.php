<?php

namespace FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business\Processor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerFacadeInterface;
use FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeInterface;
use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class RegistrationProcessorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeInterface|MockObject $customerRegistrationFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerRegistrationSalesConnectorToCustomerFacadeInterface|MockObject $customerFacadeMock;

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
    protected $customerResponseTransferMock;

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

        $this->customerFacadeMock = $this->getMockBuilder(CustomerRegistrationSalesConnectorToCustomerFacadeInterface::class)
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

        $this->customerResponseTransferMock = $this->getMockBuilder(CustomerResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->processor = new RegistrationProcessor(
            $this->customerFacadeMock,
            $this->customerRegistrationFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testProcessRegistration(): void
    {
        $self = $this;

        $this->quoteTransferMock->expects($this->atLeastOnce())->method('getCreateAccount')->willReturn(true);
        $this->quoteTransferMock->expects($this->atLeastOnce())->method('getAcceptTerms')->willReturn(true);
        $this->quoteTransferMock->expects($this->atLeastOnce())->method('getCustomer')->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects($this->atLeastOnce())->method('getEmail')->willReturn($this->mail);

        $this->customerFacadeMock->expects($this->atLeastOnce())->method('registerCustomer')->willReturnCallback(static function (CustomerTransfer $customerTransfer) use ($self) {
            static::assertSame($self->mail, $customerTransfer->getEmail());

            return $self->customerResponseTransferMock;
        });

        $this->processor->processRegistration(
            $this->saveOrderTransferMock,
            $this->quoteTransferMock,
        );
    }
}
