<?php

namespace FondOfOryx\Zed\OneTimePasswordEmailConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\Dependency\Facade\OneTimePasswordEmailConnectorToMailBridge;
use FondOfOryx\Zed\OneTimePasswordEmailConnector\Communication\Plugin\Mail\OneTimePasswordEmailConnectorLoginLinkMailTypeBuilderPlugin;
use FondOfOryx\Zed\OneTimePasswordEmailConnector\Communication\Plugin\Mail\OneTimePasswordEmailConnectorMailTypeBuilderPlugin;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

class OneTimePasswordEmailConnectorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\OneTimePasswordEmailConnector
     */
    protected $oneTimePasswordEmailConnector;

    /**
     * @var \FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\Dependency\Facade\OneTimePasswordEmailConnectorToMailBridge|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailBridgeMock;

    /**
     * @var \Generated\Shared\Transfer\OneTimePasswordResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var string
     */
    protected $oneTimePasswordPlain;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->mailBridgeMock = $this->getMockBuilder(OneTimePasswordEmailConnectorToMailBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordResponseTransferMock = $this->getMockBuilder(OneTimePasswordResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordPlain = 'one-time-password-plain';

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordEmailConnector = new OneTimePasswordEmailConnector(
            $this->mailBridgeMock,
            [
                OneTimePasswordEmailConnector::MAIL_TYPE => OneTimePasswordEmailConnectorMailTypeBuilderPlugin::MAIL_TYPE,
                OneTimePasswordEmailConnector::MAIL_TYPE_LOGIN_LINK => OneTimePasswordEmailConnectorLoginLinkMailTypeBuilderPlugin::MAIL_TYPE,
            ],
        );
    }

    /**
     * @return void
     */
    public function testSendOneTimePasswordMail(): void
    {
        $this->oneTimePasswordResponseTransferMock->expects($this->atLeastOnce())
            ->method('requireOneTimePasswordPlain')
            ->willReturnSelf();

        $this->oneTimePasswordResponseTransferMock->expects($this->atLeastOnce())
            ->method('requireCustomerTransfer')
            ->willReturnSelf();

        $this->oneTimePasswordResponseTransferMock->expects($this->atLeastOnce())
            ->method('getCustomerTransfer')
            ->willReturn($this->customerTransferMock);

        $this->oneTimePasswordResponseTransferMock->expects($this->atLeastOnce())
            ->method('getOneTimePasswordPlain')
            ->willReturn($this->oneTimePasswordPlain);

        $this->customerTransferMock->expects($this->atLeastOnce())
            ->method('getLocale')
            ->willReturn($this->localeTransferMock);

        $this->mailBridgeMock->expects($this->atLeastOnce())
            ->method('handleMail');

        $this->oneTimePasswordEmailConnector->sendOneTimePasswordMail(
            $this->oneTimePasswordResponseTransferMock,
        );
    }
}
