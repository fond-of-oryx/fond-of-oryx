<?php

namespace FondOfOryx\Zed\OneTimePassword\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordEncoderInterface;
use FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGeneratorInterface;
use FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordLinkGeneratorInterface;
use FondOfOryx\Zed\OneTimePassword\Business\Resetter\OneTimePasswordResetterInterface;
use FondOfOryx\Zed\OneTimePassword\Business\Sender\OneTimePasswordSenderInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class OneTimePasswordFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordFacade
     */
    protected $oneTimePasswordFacade;

    /**
     * @var \Generated\Shared\Transfer\OneTimePasswordResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordBusinessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Sender\OneTimePasswordSenderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordSenderMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGeneratorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordGeneratorMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Resetter\OneTimePasswordResetterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordResetterMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordLinkGeneratorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordLinkGeneratorMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordEncoderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordEncoderMock;

    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->oneTimePasswordResponseTransferMock = $this->getMockBuilder(OneTimePasswordResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordBusinessFactoryMock = $this->getMockBuilder(OneTimePasswordBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordSenderMock = $this->getMockBuilder(OneTimePasswordSenderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordGeneratorMock = $this->getMockBuilder(OneTimePasswordGeneratorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordResetterMock = $this->getMockBuilder(OneTimePasswordResetterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordLinkGeneratorMock = $this->getMockBuilder(OneTimePasswordLinkGeneratorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordEncoderMock = $this->getMockBuilder(OneTimePasswordEncoderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderTransferMock = $this->getMockBuilder(OrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordFacade = new OneTimePasswordFacade();
        $this->oneTimePasswordFacade->setFactory($this->oneTimePasswordBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testRequestOneTimePassword(): void
    {
        $this->oneTimePasswordBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createOneTimePasswordSender')
            ->willReturn($this->oneTimePasswordSenderMock);

        $this->oneTimePasswordSenderMock->expects($this->atLeastOnce())
            ->method('requestOneTimePassword')
            ->with($this->customerTransferMock)
            ->willReturn($this->oneTimePasswordResponseTransferMock);

        $this->assertSame(
            $this->oneTimePasswordResponseTransferMock,
            $this->oneTimePasswordFacade->requestOneTimePassword(
                $this->customerTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGenerateOneTimePassword(): void
    {
        $this->oneTimePasswordBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createOneTimePasswordGenerator')
            ->willReturn($this->oneTimePasswordGeneratorMock);

        $this->oneTimePasswordGeneratorMock->expects($this->atLeastOnce())
            ->method('generateOneTimePassword')
            ->with($this->customerTransferMock)
            ->willReturn($this->oneTimePasswordResponseTransferMock);

        $this->assertSame(
            $this->oneTimePasswordResponseTransferMock,
            $this->oneTimePasswordFacade->generateOneTimePassword(
                $this->customerTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testResetOneTimePassword(): void
    {
        $this->oneTimePasswordBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createOneTimePasswordResetter')
            ->willReturn($this->oneTimePasswordResetterMock);

        $this->oneTimePasswordResetterMock->expects($this->atLeastOnce())
            ->method('resetOneTimePassword')
            ->with($this->customerTransferMock);

        $this->oneTimePasswordFacade->resetOneTimePassword(
            $this->customerTransferMock,
        );
    }

    /**
     * @return void
     */
    public function testGenerateOneTimePasswordLoginLink(): void
    {
        $this->oneTimePasswordBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createOneTimePasswordLinkGenerator')
            ->willReturn($this->oneTimePasswordLinkGeneratorMock);

        $this->oneTimePasswordLinkGeneratorMock->expects($this->atLeastOnce())
            ->method('generateLoginLink')
            ->willReturn($this->oneTimePasswordResponseTransferMock);

        $this->assertSame(
            $this->oneTimePasswordResponseTransferMock,
            $this->oneTimePasswordFacade->generateLoginLink(
                $this->customerTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGenerateLoginLinkWithOrderReference(): void
    {
        $this->oneTimePasswordBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createOneTimePasswordLinkGenerator')
            ->willReturn($this->oneTimePasswordLinkGeneratorMock);

        $this->oneTimePasswordLinkGeneratorMock->expects($this->atLeastOnce())
            ->method('generateLoginLinkWithOrderReference')
            ->willReturn($this->oneTimePasswordResponseTransferMock);

        $this->assertSame(
            $this->oneTimePasswordResponseTransferMock,
            $this->oneTimePasswordFacade->generateLoginLinkWithOrderReference(
                $this->orderTransferMock,
            ),
        );
    }
}
