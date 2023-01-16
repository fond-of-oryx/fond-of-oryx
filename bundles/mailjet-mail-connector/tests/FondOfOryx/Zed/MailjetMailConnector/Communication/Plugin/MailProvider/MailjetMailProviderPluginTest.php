<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Communication\Plugin\MailProvider;

use Codeception\Test\Unit;
use FondOfOryx\Zed\MailjetMailConnector\Business\MailjetMailConnectorFacade;
use Generated\Shared\Transfer\MailTransfer;

class MailjetMailProviderPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailTransferMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Business\MailjetMailConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Communication\Plugin\MailProvider\MailjetMailProviderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(MailjetMailConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new MailjetMailProviderPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testSendMail(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('sendMail')
            ->with($this->mailTransferMock);

        $this->plugin->sendMail($this->mailTransferMock);
    }
}
