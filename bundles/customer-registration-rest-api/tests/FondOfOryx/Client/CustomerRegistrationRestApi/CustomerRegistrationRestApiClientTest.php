<?php

namespace FondOfOryx\Client\CustomerRegistrationRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\CustomerRegistrationRestApi\Zed\CustomerRegistrationRestApiStubInterface;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerRegistrationResponseTransfer;

class CustomerRegistrationRestApiClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\CustomerRegistrationRestApi\CustomerRegistrationRestApiClient
     */
    protected $customerRegistrationRestApiClient;

    /**
     * @var \FondOfOryx\Client\CustomerRegistrationRestApi\CustomerRegistrationRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationRestApiFactoryMock;

    /**
     * @var \FondOfOryx\Client\CustomerRegistrationRestApi\Zed\CustomerRegistrationRestApiStubInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationRestApiStubMock;

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
        $this->customerRegistrationRestApiFactoryMock = $this->getMockBuilder(CustomerRegistrationRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationRestApiStubMock = $this->getMockBuilder(CustomerRegistrationRestApiStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationRequestTransferMock = $this->getMockBuilder(CustomerRegistrationRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationResponseTransferMock = $this->getMockBuilder(CustomerRegistrationResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationRestApiClient = new CustomerRegistrationRestApiClient();
        $this->customerRegistrationRestApiClient->setFactory($this->customerRegistrationRestApiFactoryMock);
    }

    /**
     * @return void
     */
    public function testHandleCustomerRegistrationRequest(): void
    {
        $this->customerRegistrationRestApiFactoryMock->expects($this->atLeastOnce())
            ->method('createCustomerRegistrationZedStub')
            ->willReturn($this->customerRegistrationRestApiStubMock);

        $this->customerRegistrationRestApiStubMock->expects($this->atLeastOnce())
            ->method('handleCustomerRegistrationRequest')
            ->with($this->customerRegistrationRequestTransferMock)
            ->willReturn($this->customerRegistrationResponseTransferMock);

        $this->customerRegistrationRestApiClient->handleCustomerRegistrationRequest(
            $this->customerRegistrationRequestTransferMock,
        );
    }
}
