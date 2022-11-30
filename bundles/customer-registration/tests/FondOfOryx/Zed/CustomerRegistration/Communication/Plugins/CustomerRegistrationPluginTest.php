<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistration\Business\CustomerRegistrationFacade;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;

class CustomerRegistrationPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPluginInterface
     */
    protected $plugin;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\CustomerRegistrationFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationRequestTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->facadeMock = $this->getMockBuilder(CustomerRegistrationFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationRequestTransferMock = $this->getMockBuilder(CustomerRegistrationRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CustomerRegistrationPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExecute(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())->method('registerCustomer')->willReturn($this->customerRegistrationRequestTransferMock);

        $this->plugin->execute($this->customerRegistrationRequestTransferMock);
    }
}
