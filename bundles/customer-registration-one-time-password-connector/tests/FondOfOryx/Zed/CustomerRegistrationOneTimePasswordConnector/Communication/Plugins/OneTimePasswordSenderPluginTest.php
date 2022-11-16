<?php

namespace FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Communication\Plugins;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business\CustomerRegistrationOneTimePasswordConnectorFacade;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;

class OneTimePasswordSenderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Communication\Plugins\OneTimePasswordSenderPlugin
     */
    protected $plugin;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business\CustomerRegistrationOneTimePasswordConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
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

        $this->facadeMock = $this->getMockBuilder(CustomerRegistrationOneTimePasswordConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new OneTimePasswordSenderPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExecute(): void
    {
        $this->facadeMock->expects(static::once())
            ->method('sendOneTimePassword');

        $this->plugin->execute($this->customerRegistrationRequestTransferMock);
    }
}
