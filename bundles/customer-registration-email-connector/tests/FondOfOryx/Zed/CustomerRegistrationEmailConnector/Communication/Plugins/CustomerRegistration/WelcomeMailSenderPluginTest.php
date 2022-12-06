<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Communication\Plugins\CustomerRegistration;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\CustomerRegistrationEmailConnectorFacade;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;

class WelcomeMailSenderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Communication\Plugins\CustomerRegistration\WelcomeMailSenderPlugin
     */
    protected $plugin;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationRequestTransferMock;

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

        $this->facadeMock = $this->getMockBuilder(CustomerRegistrationEmailConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new WelcomeMailSenderPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExecute(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('sendWelcomeMail');

        $this->plugin->execute($this->customerRegistrationRequestTransferMock);
    }
}
