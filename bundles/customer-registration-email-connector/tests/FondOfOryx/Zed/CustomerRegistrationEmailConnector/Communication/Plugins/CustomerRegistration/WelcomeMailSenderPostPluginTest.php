<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Communication\Plugins\CustomerRegistration;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Shared\CustomerRegistration\CustomerRegistrationConstants;
use FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\CustomerRegistrationEmailConnectorFacade;
use Generated\Shared\Transfer\CustomerRegistrationBagTransfer;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class WelcomeMailSenderPostPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Communication\Plugins\CustomerRegistration\WelcomeMailSenderPostPlugin
     */
    protected $plugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CustomerRegistrationBagTransfer
     */
    protected $bagTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\CustomerRegistrationEmailConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->customerRegistrationRequestTransferMock = $this->getMockBuilder(CustomerRegistrationRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bagTransferMock = $this->getMockBuilder(CustomerRegistrationBagTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(CustomerRegistrationEmailConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new WelcomeMailSenderPostPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExecute(): void
    {
        $this->customerRegistrationRequestTransferMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CustomerRegistrationConstants::TYPE_REGISTRATION);

        $this->customerRegistrationRequestTransferMock->expects(static::atLeastOnce())
            ->method('getBagOrFail')
            ->willReturn($this->bagTransferMock);

        $this->customerRegistrationRequestTransferMock->expects(static::atLeastOnce())
            ->method('setBag')
            ->with($this->bagTransferMock)
            ->willReturnSelf();

        $this->bagTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->bagTransferMock->expects(static::atLeastOnce())
            ->method('getEmailVerificationLink')
            ->willReturn('link');

        $this->bagTransferMock->expects(static::atLeastOnce())
            ->method('setMessage')
            ->with('Verification Link successfully sent!')
            ->willReturnSelf();

        $this->bagTransferMock->expects(static::atLeastOnce())
            ->method('setIsWelcomeMailSent')
            ->with(true)
            ->willReturnSelf();

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('sendWelcomeMail');

        $this->plugin->execute($this->customerRegistrationRequestTransferMock);
    }

    /**
     * @return void
     */
    public function testExecuteThrowsException(): void
    {
        $this->customerRegistrationRequestTransferMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CustomerRegistrationConstants::TYPE_REGISTRATION);

        $this->customerRegistrationRequestTransferMock->expects(static::atLeastOnce())
            ->method('getBagOrFail')
            ->willReturn($this->bagTransferMock);

        $this->customerRegistrationRequestTransferMock->expects(static::atLeastOnce())
            ->method('setBag')
            ->with($this->bagTransferMock)
            ->willReturnSelf();

        $this->bagTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->bagTransferMock->expects(static::atLeastOnce())
            ->method('getEmailVerificationLink')
            ->willReturn('link');

        $this->bagTransferMock->expects(static::atLeastOnce())
            ->method('setMessage')
            ->with('Could not send verification Link!')
            ->willReturnSelf();

        $this->bagTransferMock->expects(static::atLeastOnce())
            ->method('setIsWelcomeMailSent')
            ->with(false)
            ->willReturnSelf();

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('sendWelcomeMail')->willThrowException(new Exception('test'));

        $this->plugin->execute($this->customerRegistrationRequestTransferMock);
    }

    /**
     * @return void
     */
    public function testExecuteWillNotSendWelcomeMail(): void
    {
        $this->customerRegistrationRequestTransferMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CustomerRegistrationConstants::TYPE_EMAIL_VERIFICATION);

        $this->customerRegistrationRequestTransferMock->expects(static::never())
            ->method('getBagOrFail');

        $this->plugin->execute($this->customerRegistrationRequestTransferMock);
    }
}
