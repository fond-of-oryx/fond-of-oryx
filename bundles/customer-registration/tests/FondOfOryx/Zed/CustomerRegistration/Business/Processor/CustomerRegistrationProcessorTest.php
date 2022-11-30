<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Processor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPluginInterface;
use Generated\Shared\Transfer\CustomerRegistrationBagTransfer;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;

class CustomerRegistrationProcessorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $pluginMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationBagTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationBagTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\Processor\CustomerRegistrationProcessorInterface
     */
    protected $processor;

    /**
     * @return void
     */
    public function _before(): void
    {
        parent::_before();

        $this->pluginMock = $this->getMockBuilder(CustomerRegistrationPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationRequestTransferMock = $this->getMockBuilder(CustomerRegistrationRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationBagTransferMock = $this->getMockBuilder(CustomerRegistrationBagTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->processor = new CustomerRegistrationProcessor(
            [
                $this->pluginMock,
                $this->pluginMock,
            ],
        );
    }

    /**
     * @return void
     */
    public function testProcessCustomerRegistration(): void
    {
        $this->pluginMock->expects(static::exactly(2))->method('execute')->willReturn($this->customerRegistrationRequestTransferMock);
        $this->customerRegistrationRequestTransferMock->expects(static::once())->method('getBagOrFail')->willReturn($this->customerRegistrationBagTransferMock);
        $this->customerRegistrationBagTransferMock->expects(static::once())->method('toArray')->willReturn([]);
        $this->processor->processCustomerRegistration($this->customerRegistrationRequestTransferMock);
    }
}
