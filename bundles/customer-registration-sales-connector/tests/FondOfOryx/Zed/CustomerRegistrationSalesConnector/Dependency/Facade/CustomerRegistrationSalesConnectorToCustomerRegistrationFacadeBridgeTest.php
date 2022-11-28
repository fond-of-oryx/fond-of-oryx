<?php

namespace FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistration\Business\CustomerRegistrationFacadeInterface;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerRegistrationResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeBridge
     */
    protected $facade;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\CustomerRegistrationFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->facadeMock = $this->getMockBuilder(CustomerRegistrationFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationRequestTransferMock = $this->getMockBuilder(CustomerRegistrationRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationResponseTransferMock = $this->getMockBuilder(CustomerRegistrationResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeBridge(
            $this->facadeMock,
        );
    }

    /**
     * @return void
     */
    public function testCustomerRegistration(): void
    {
        $this->facadeMock->expects(static::once())->method('customerRegistration')->willReturn($this->customerRegistrationResponseTransferMock);

        $this->facade->customerRegistration(
            $this->customerRegistrationRequestTransferMock,
        );
    }

    /**
     * @return void
     */
    public function testFlagCustomerAsGdprAccepted(): void
    {
        $this->facadeMock->expects(static::once())->method('flagCustomerAsGdprAccepted')->willReturn($this->customerTransferMock);

        $this->facade->flagCustomerAsGdprAccepted(
            $this->customerTransferMock,
        );
    }
}
