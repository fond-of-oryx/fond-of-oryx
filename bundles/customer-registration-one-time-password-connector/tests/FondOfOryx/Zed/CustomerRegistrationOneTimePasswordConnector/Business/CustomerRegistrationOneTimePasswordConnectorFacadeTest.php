<?php

namespace FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business\Steps\OneTimePasswordStepInterface;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;

class CustomerRegistrationOneTimePasswordConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business\CustomerRegistrationOneTimePasswordConnectorFacade
     */
    protected $facade;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business\CustomerRegistrationOneTimePasswordConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business\Steps\OneTimePasswordStepInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordStepMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->factoryMock = $this->getMockBuilder(CustomerRegistrationOneTimePasswordConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationRequestTransferMock = $this->getMockBuilder(CustomerRegistrationRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordStepMock = $this->getMockBuilder(OneTimePasswordStepInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CustomerRegistrationOneTimePasswordConnectorFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testSendOneTimePassword(): void
    {
        $this->factoryMock->expects($this->atLeastOnce())
            ->method('createOneTimePasswordStep')
            ->willReturn($this->oneTimePasswordStepMock);

        $this->oneTimePasswordStepMock->expects($this->atLeastOnce())
            ->method('sendLoginLink')
            ->with($this->customerRegistrationRequestTransferMock);

        $this->facade->sendOneTimePassword($this->customerRegistrationRequestTransferMock);
    }
}
