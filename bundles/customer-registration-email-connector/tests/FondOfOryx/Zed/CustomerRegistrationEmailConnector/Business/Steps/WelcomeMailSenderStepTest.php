<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Steps;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Sender\WelcomeMailSenderInterface;
use FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface;
use FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPreStepConditionPluginInterface;
use Generated\Shared\Transfer\CustomerRegistrationBagTransfer;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class WelcomeMailSenderStepTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Steps\WelcomeMailSenderStepInterface
     */
    protected $step;

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
     * @var \FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPreStepConditionPluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $prePluginMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $postPluginMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Sender\WelcomeMailSenderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $welcomeMailSenderMock;

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

        $this->prePluginMock = $this->getMockBuilder(CustomerRegistrationPreStepConditionPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->postPluginMock = $this->getMockBuilder(CustomerRegistrationPostStepPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->welcomeMailSenderMock = $this->getMockBuilder(WelcomeMailSenderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->step = new WelcomeMailSenderStep(
            $this->welcomeMailSenderMock,
            [
                $this->prePluginMock,
                $this->prePluginMock,
            ],
            [
                $this->postPluginMock,
                $this->postPluginMock,
            ],
        );
    }

    /**
     * @return void
     */
    public function testSendWelcomeMail(): void
    {
        $this->prePluginMock->expects(static::atLeastOnce())
            ->method('checkPreCondition')
            ->willReturn(true);

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

        $this->postPluginMock->expects(static::atLeastOnce())
            ->method('execute')->willReturn($this->customerRegistrationRequestTransferMock);

        $this->welcomeMailSenderMock->expects(static::atLeastOnce())
            ->method('sendWelcomeMail');

        $this->step->sendWelcomeMail($this->customerRegistrationRequestTransferMock);
    }

    /**
     * @return void
     */
    public function testExecuteThrowsException(): void
    {
        $this->prePluginMock->expects(static::atLeastOnce())
            ->method('checkPreCondition')
            ->willReturn(true);

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

        $this->postPluginMock->expects(static::atLeastOnce())
            ->method('execute')->willReturn($this->customerRegistrationRequestTransferMock);

        $this->welcomeMailSenderMock->expects(static::atLeastOnce())
            ->method('sendWelcomeMail')->willThrowException(new Exception('test'));

        $this->step->sendWelcomeMail($this->customerRegistrationRequestTransferMock);
    }

    /**
     * @return void
     */
    public function testExecuteWillNotSendWelcomeMail(): void
    {
        $this->prePluginMock->expects(static::atLeastOnce())
            ->method('checkPreCondition')
            ->willReturn(false);

        $this->customerRegistrationRequestTransferMock->expects(static::never())
            ->method('getBagOrFail');

        $this->welcomeMailSenderMock->expects(static::never())
            ->method('sendWelcomeMail');

        $this->step->sendWelcomeMail($this->customerRegistrationRequestTransferMock);
    }
}
