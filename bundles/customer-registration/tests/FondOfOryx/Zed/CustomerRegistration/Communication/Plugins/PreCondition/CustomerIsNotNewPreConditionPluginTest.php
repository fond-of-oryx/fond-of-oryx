<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\PreCondition;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerRegistrationBagTransfer;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class CustomerIsNotNewPreConditionPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPreStepConditionPluginInterface
     */
    protected $plugin;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationBagTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $bagTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

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

        $this->plugin = new CustomerIsNotNewPreConditionPlugin();
    }

    /**
     * @return void
     */
    public function testCheckPreConditionIsFalse(): void
    {
        $this->customerRegistrationRequestTransferMock->expects(static::atLeastOnce())->method('getBagOrFail')->willReturn($this->bagTransferMock);
        $this->bagTransferMock->expects(static::atLeastOnce())->method('getCustomer')->willReturn($this->customerTransferMock);
        $this->customerTransferMock->expects(static::atLeastOnce())->method('getIsNew')->willReturn(true);

        static::assertFalse($this->plugin->checkPreCondition($this->customerRegistrationRequestTransferMock));
    }

    /**
     * @return void
     */
    public function testCheckPreConditionIsTrue(): void
    {
        $this->customerRegistrationRequestTransferMock->expects(static::atLeastOnce())->method('getBagOrFail')->willReturn($this->bagTransferMock);
        $this->bagTransferMock->expects(static::atLeastOnce())->method('getCustomer')->willReturn($this->customerTransferMock);
        $this->customerTransferMock->expects(static::atLeastOnce())->method('getIsNew')->willReturn(null);

        static::assertTrue($this->plugin->checkPreCondition($this->customerRegistrationRequestTransferMock));
    }
}
