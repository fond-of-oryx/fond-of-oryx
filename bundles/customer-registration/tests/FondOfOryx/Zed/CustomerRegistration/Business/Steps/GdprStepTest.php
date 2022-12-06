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

class GdprStepTest extends Unit
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
    protected $customerRegistrationRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationBagTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationBagTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\Steps\GdprStepInterface
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

        $this->customerRegistrationRequestTransferMock = $this->getMockBuilder(CustomerRegistrationRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationBagTransferMock = $this->getMockBuilder(CustomerRegistrationBagTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationAttributesTransferMock = $this->getMockBuilder(CustomerRegistrationAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->step = new GdprStep(
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
    public function testCheckGdprState(): void
    {
        $this->postPluginMock->expects(static::exactly(2))->method('execute')->willReturn($this->customerRegistrationRequestTransferMock);
        $this->prePluginMock->expects(static::exactly(2))->method('checkPreCondition')->willReturn(true);
        $this->customerRegistrationRequestTransferMock->expects(static::once())->method('getBag')->willReturn($this->customerRegistrationBagTransferMock);
        $this->customerRegistrationRequestTransferMock->expects(static::once())->method('getAttributesOrFail')->willReturn($this->customerRegistrationAttributesTransferMock);
        $this->entityManagerMock->expects(static::once())->method('flagCustomerAsGdprAccepted')->willReturn($this->customerTransferMock);
        $this->customerRegistrationBagTransferMock->expects(static::once())->method('getCustomerOrFail')->willReturn($this->customerTransferMock);
        $this->customerRegistrationBagTransferMock->expects(static::once())->method('setCustomer')->willReturnSelf();
        $this->customerRegistrationBagTransferMock->expects(static::atLeastOnce())->method('setGdprAccepted')->willReturnSelf();
        $this->customerRegistrationAttributesTransferMock->expects(static::atLeastOnce())->method('getAcceptGdpr')->willReturn(true);
        $this->customerRegistrationRequestTransferMock->expects(static::once())->method('setBag')->willReturnSelf();
        $this->step->checkGdprState($this->customerRegistrationRequestTransferMock);
    }

    /**
     * @return void
     */
    public function testCheckGdprStatePreConditionFails(): void
    {
        $this->postPluginMock->expects(static::never())->method('execute')->willReturn($this->customerRegistrationRequestTransferMock);
        $this->prePluginMock->expects(static::once())->method('checkPreCondition')->willReturn(false);
        $this->entityManagerMock->expects(static::never())->method('flagCustomerAsGdprAccepted');
        $this->customerRegistrationRequestTransferMock->expects(static::once())->method('setBag')->willReturnSelf();
        $this->step->checkGdprState($this->customerRegistrationRequestTransferMock);
    }
}
