<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\PostStep;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationRepository;
use Generated\Shared\Transfer\CustomerRegistrationAttributesTransfer;
use Generated\Shared\Transfer\CustomerRegistrationBagTransfer;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class ResoloveCustomerByTokenPostStepPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface
     */
    protected $plugin;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationRequestTransferMock;

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
     * @return void
     */
    protected function _before(): void
    {
        $this->repositoryMock = $this->getMockBuilder(CustomerRegistrationRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationRequestTransferMock = $this->getMockBuilder(CustomerRegistrationRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bagTransferMock = $this->getMockBuilder(CustomerRegistrationBagTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->attributesTransferMock = $this->getMockBuilder(CustomerRegistrationAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new ResolveCustomerByTokenPostStepPlugin();
        $this->plugin->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testExecute(): void
    {
        $this->customerRegistrationRequestTransferMock->expects(static::atLeastOnce())->method('getBagOrFail')->willReturn($this->bagTransferMock);
        $this->customerRegistrationRequestTransferMock->expects(static::atLeastOnce())->method('getAttributesOrFail')->willReturn($this->attributesTransferMock);
        $this->customerRegistrationRequestTransferMock->expects(static::atLeastOnce())->method('setBag')->willReturnSelf();
        $this->bagTransferMock->expects(static::atLeastOnce())->method('getCustomer')->willReturn(null);
        $this->bagTransferMock->expects(static::atLeastOnce())->method('setCustomer')->with($this->customerTransferMock)->willReturnSelf();
        $this->attributesTransferMock->expects(static::atLeastOnce())->method('getTokenOrFail')->willReturn('asdfg');
        $this->repositoryMock->expects(static::atLeastOnce())->method('findCustomerByToken')->willReturn($this->customerTransferMock);

        $this->plugin->execute($this->customerRegistrationRequestTransferMock);
    }

    /**
     * @return void
     */
    public function testExecuteNothingToResolve(): void
    {
        $this->customerRegistrationRequestTransferMock->expects(static::atLeastOnce())->method('getBagOrFail')->willReturn($this->bagTransferMock);
        $this->bagTransferMock->expects(static::atLeastOnce())->method('getCustomer')->willReturn($this->customerTransferMock);
        $this->repositoryMock->expects(static::never())->method('findCustomerByToken');

        $this->plugin->execute($this->customerRegistrationRequestTransferMock);
    }
}
