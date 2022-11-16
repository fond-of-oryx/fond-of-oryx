<?php

namespace FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business\Steps;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Dependency\Facade\CustomerRegistrationOneTimePasswordConnectorToOneTimePasswordFacadeInterface;
use Generated\Shared\Transfer\CustomerRegistrationBagTransfer;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

class OneTimePasswordStepTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Dependency\Facade\CustomerRegistrationOneTimePasswordConnectorToOneTimePasswordFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $otpFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationBagTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $bagTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OneTimePasswordResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $otpResponseTransferMock;

    /**
     * @var array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPreStepConditionPluginInterface>
     */
    protected $prePluginMocks = [];

    /**
     * @var array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface>
     */
    protected $postPluginMocks = [];

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business\Steps\OneTimePasswordStepInterface
     */
    protected $step;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationRequestTransferMock = $this->getMockBuilder(CustomerRegistrationRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bagTransferMock = $this->getMockBuilder(CustomerRegistrationBagTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->otpResponseTransferMock = $this->getMockBuilder(OneTimePasswordResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->otpFacadeMock = $this->getMockBuilder(CustomerRegistrationOneTimePasswordConnectorToOneTimePasswordFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->step = new OneTimePasswordStep(
            $this->otpFacadeMock,
            $this->prePluginMocks,
            $this->postPluginMocks,
        );
    }

    /**
     * @return void
     */
    public function testSendLoginLink(): void
    {
        $this->customerRegistrationRequestTransferMock->expects(static::atLeastOnce())->method('getBag')->willReturn($this->bagTransferMock);
        $this->customerRegistrationRequestTransferMock->expects(static::atLeastOnce())->method('setBag')->with($this->bagTransferMock)->willReturnSelf();
        $this->otpFacadeMock->expects(static::atLeastOnce())->method('requestLoginLink')->willReturn($this->otpResponseTransferMock);
        $this->otpResponseTransferMock->expects(static::atLeastOnce())->method('getIsSuccess')->willReturn(true);
        $this->bagTransferMock->expects(static::atLeastOnce())->method('getCustomerOrFail')->willReturn($this->customerTransferMock);
        $this->bagTransferMock->expects(static::exactly(2))->method('setMessage')->willReturnSelf();
        $this->bagTransferMock->expects(static::atLeastOnce())->method('setIsLoginLinkSent')->with(true)->willReturnSelf();
        $this->bagTransferMock->expects(static::atLeastOnce())->method('setOneTimePasswordResponse')->with($this->otpResponseTransferMock)->willReturnSelf();

        $this->step->sendLoginLink(
            $this->customerRegistrationRequestTransferMock,
        );
    }
}
