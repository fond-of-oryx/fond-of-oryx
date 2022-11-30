<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\PreCondition;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerRegistrationAttributesTransfer;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;

class EmailAddressVerificationIsRequestedPreConditionPluginTest extends Unit
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
     * @var \Generated\Shared\Transfer\CustomerRegistrationAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $attributesTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->customerRegistrationRequestTransferMock = $this->getMockBuilder(CustomerRegistrationRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->attributesTransferMock = $this->getMockBuilder(CustomerRegistrationAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new EmailAddressVerificationIsRequestedPreConditionPlugin();
    }

    /**
     * @return void
     */
    public function testCheckPreConditionIsTrue(): void
    {
        $this->customerRegistrationRequestTransferMock->expects(static::atLeastOnce())->method('getAttributesOrFail')->willReturn($this->attributesTransferMock);
        $this->attributesTransferMock->expects(static::atLeastOnce())->method('getVerifyEmail')->willReturn(true);

        static::assertTrue($this->plugin->checkPreCondition($this->customerRegistrationRequestTransferMock));
    }

    /**
     * @return void
     */
    public function testCheckPreConditionIsFalse(): void
    {
        $this->customerRegistrationRequestTransferMock->expects(static::atLeastOnce())->method('getAttributesOrFail')->willReturn($this->attributesTransferMock);
        $this->attributesTransferMock->expects(static::atLeastOnce())->method('getVerifyEmail')->willReturn(null);

        static::assertFalse($this->plugin->checkPreCondition($this->customerRegistrationRequestTransferMock));
    }
}
