<?php

namespace FondOfOryx\Zed\OneTimePassword\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordFacade;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class LoginLinkOrderMailExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Communication\Plugin\LoginLinkOrderMailExpanderPlugin
     */
    protected $addLoginLinkOmsOrderMailExpanderPlugin;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderTransferMock;

    /**
     * @var string
     */
    protected $loginLink;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->oneTimePasswordFacadeMock = $this->getMockBuilder(OneTimePasswordFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderTransferMock = $this->getMockBuilder(OrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loginLink = 'login-link';

        $this->addLoginLinkOmsOrderMailExpanderPlugin = new LoginLinkOrderMailExpanderPlugin();
        $this->addLoginLinkOmsOrderMailExpanderPlugin->setFacade($this->oneTimePasswordFacadeMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->oneTimePasswordFacadeMock->expects($this->atLeastOnce())
            ->method('generateLoginLinkWithOrderReference')
            ->with($this->orderTransferMock)
            ->willReturn($this->loginLink);

        $this->mailTransferMock->expects($this->atLeastOnce())
            ->method('setLoginLink')
            ->with($this->loginLink)
            ->willReturnSelf();

        $this->assertSame(
            $this->mailTransferMock,
            $this->addLoginLinkOmsOrderMailExpanderPlugin->expand(
                $this->mailTransferMock,
                $this->orderTransferMock
            )
        );
    }
}
