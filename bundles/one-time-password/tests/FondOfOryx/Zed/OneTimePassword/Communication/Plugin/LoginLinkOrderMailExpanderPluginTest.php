<?php

namespace FondOfOryx\Zed\OneTimePassword\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordFacade;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class LoginLinkOrderMailExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Communication\Plugin\LoginLinkOrderMailExpanderPlugin
     */
    protected LoginLinkOrderMailExpanderPlugin $addLoginLinkOmsOrderMailExpanderPlugin;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OneTimePasswordFacade|MockObject $oneTimePasswordFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|MailTransfer $mailTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|OrderTransfer $orderTransferMock;

    /**
     * @var string
     */
    protected string $loginLink;

    /**
     * @var \Generated\Shared\Transfer\OneTimePasswordResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OneTimePasswordResponseTransfer|MockObject $oneTimePasswordResponseTransfer;

    /**
     * @var (\Generated\Shared\Transfer\LocaleTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|LocaleTransfer $localeTransferMock;

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

        $this->oneTimePasswordResponseTransfer = $this->getMockBuilder(OneTimePasswordResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
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
        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn($this->localeTransferMock);

        $this->oneTimePasswordFacadeMock->expects(static::atLeastOnce())
            ->method('generateLoginLinkWithOrderReference')
            ->with($this->orderTransferMock)
            ->willReturn($this->oneTimePasswordResponseTransfer);

        $this->oneTimePasswordResponseTransfer->expects(static::atLeastOnce())
            ->method('getLoginLink')
            ->willReturn($this->loginLink);

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('setOneTimePasswordLoginLink')
            ->with($this->loginLink)
            ->willReturnSelf();

        static::assertSame(
            $this->mailTransferMock,
            $this->addLoginLinkOmsOrderMailExpanderPlugin->expand(
                $this->mailTransferMock,
                $this->orderTransferMock,
            ),
        );
    }
}
