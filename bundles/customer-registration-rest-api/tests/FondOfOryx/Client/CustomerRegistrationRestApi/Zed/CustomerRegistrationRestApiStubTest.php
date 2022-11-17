<?php

namespace FondOfOryx\Client\CustomerRegistrationRestApi\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\CustomerRegistrationRestApi\Dependency\Client\CustomerRegistrationRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerRegistrationResponseTransfer;

class CustomerRegistrationRestApiStubTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\CustomerRegistrationRestApi\Zed\CustomerRegistrationRestApiStub
     */
    protected $customerRegistrationRestApiStub;

    /**
     * @var \FondOfOryx\Client\CustomerRegistrationRestApi\Dependency\Client\CustomerRegistrationRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

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
        $this->zedRequestClientMock = $this->getMockBuilder(CustomerRegistrationRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationRequestTransferMock = $this->getMockBuilder(CustomerRegistrationRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationResponseTransferMock = $this->getMockBuilder(CustomerRegistrationResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationRestApiStub = new CustomerRegistrationRestApiStub(
            $this->zedRequestClientMock,
        );
    }

    /**
     * @return void
     */
    public function testHandleCustomerRegistrationRequest(): void
    {
        $this->zedRequestClientMock->expects($this->atLeastOnce())
            ->method('call')
            ->with(
                '/customer-registration/gateway/register-customer',
                $this->customerRegistrationRequestTransferMock,
            )
            ->willReturn($this->customerRegistrationResponseTransferMock);

        $this->customerRegistrationRestApiStub->handleCustomerRegistrationRequest(
            $this->customerRegistrationRequestTransferMock,
        );
    }
}
