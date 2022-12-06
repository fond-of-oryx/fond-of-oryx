<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Steps;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationEntityManagerInterface;
use FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationRepositoryInterface;
use FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface;
use FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPreStepConditionPluginInterface;
use Generated\Shared\Transfer\CustomerRegistrationAttributesTransfer;
use Generated\Shared\Transfer\CustomerRegistrationBagTransfer;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class VerificiationStepTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPreStepConditionPluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $prePluginMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $postPluginMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $requestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationBagTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $bagTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $attributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\Steps\VerificationStepInterface
     */
    protected $step;

    /**
     * @return void
     */
    public function _before(): void
    {
        parent::_before();

        $this->prePluginMock = $this->getMockBuilder(CustomerRegistrationPreStepConditionPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->postPluginMock = $this->getMockBuilder(CustomerRegistrationPostStepPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CustomerRegistrationRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(CustomerRegistrationEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestTransferMock = $this->getMockBuilder(CustomerRegistrationRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bagTransferMock = $this->getMockBuilder(CustomerRegistrationBagTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->attributesTransferMock = $this->getMockBuilder(CustomerRegistrationAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->step = new VerificationStep(
            $this->repositoryMock,
            $this->entityManagerMock,
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
    public function testVerifyEmail(): void
    {
        $token = 'token';
        $this->requestTransferMock->expects(static::once())->method('getBag')->willReturn($this->bagTransferMock);
        $this->bagTransferMock->expects(static::atLeastOnce())->method('setIsVerified')->withConsecutive([false], [true])->willReturnSelf();
        $this->prePluginMock->expects(static::exactly(2))->method('checkPreCondition')->willReturn(true);
        $this->bagTransferMock->expects(static::once())->method('getCustomerOrFail')->willReturn($this->customerTransferMock);
        $this->requestTransferMock->expects(static::once())->method('getAttributesOrFail')->willReturn($this->attributesTransferMock);
        $this->attributesTransferMock->expects(static::atLeastOnce())->method('getToken')->willReturn($token);
        $this->customerTransferMock->expects(static::atLeastOnce())->method('getRegistrationKey')->willReturn($token);
        $this->entityManagerMock->expects(static::once())->method('flagCustomerAsVerified')->willReturn($this->customerTransferMock);
        $this->requestTransferMock->expects(static::once())->method('setBag')->willReturnSelf();
        $this->postPluginMock->expects(static::exactly(2))->method('execute')->willReturn($this->requestTransferMock);
        $this->step->verifyEmail($this->requestTransferMock);
    }

    /**
     * @return void
     */
    public function testVerifyEmailPreConditionFails(): void
    {
        $this->requestTransferMock->expects(static::once())->method('getBag')->willReturn($this->bagTransferMock);
        $this->bagTransferMock->expects(static::atLeastOnce())->method('setIsVerified')->withConsecutive([false], [true])->willReturnSelf();
        $this->postPluginMock->expects(static::exactly(2))->method('execute')->willReturn($this->requestTransferMock);
        $this->prePluginMock->expects(static::once())->method('checkPreCondition')->willReturn(false);
        $this->entityManagerMock->expects(static::never())->method('flagCustomerAsVerified');
        $this->bagTransferMock->expects(static::once())->method('getCustomerOrFail')->willReturn($this->customerTransferMock);
        $this->customerTransferMock->expects(static::atLeastOnce())->method('getIsVerified')->willReturn(true);
        $this->requestTransferMock->expects(static::once())->method('setBag')->willReturnSelf();
        $this->step->verifyEmail($this->requestTransferMock);
    }
}
