<?php

namespace FondOfOryx\Zed\OneTimePasswordRestApi\Business\Sender;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePasswordRestApi\Dependency\Facade\OneTimePasswordRestApiToOneTimePasswordFacadeInterface;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer;

class OneTimePasswordRestApiSenderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePasswordRestApi\Business\Sender\OneTimePasswordRestApiSender
     */
    protected $oneTimePasswordRestApiSender;

    /**
     * @var \FondOfOryx\Zed\OneTimePasswordRestApi\Dependency\Facade\OneTimePasswordRestApiToOneTimePasswordFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restOneTimePasswordRequestAttributesTransferMock;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var \Generated\Shared\Transfer\OneTimePasswordResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restOneTimePasswordLoginLinkRequestAttributesTransferMock;

    /**
     * @var string
     */
    protected $orderReference;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->oneTimePasswordFacadeMock = $this->getMockBuilder(OneTimePasswordRestApiToOneTimePasswordFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOneTimePasswordRequestAttributesTransferMock = $this->getMockBuilder(RestOneTimePasswordRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->email = 'email';

        $this->oneTimePasswordResponseTransferMock = $this->getMockBuilder(OneTimePasswordResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOneTimePasswordLoginLinkRequestAttributesTransferMock = $this->getMockBuilder(RestOneTimePasswordLoginLinkRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderReference = 'order-reference';

        $this->oneTimePasswordRestApiSender = new OneTimePasswordRestApiSender(
            $this->oneTimePasswordFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testRequestOneTimePassword(): void
    {
        $this->restOneTimePasswordRequestAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getEmail')
            ->willReturn($this->email);

        $this->oneTimePasswordFacadeMock->expects($this->atLeastOnce())
            ->method('requestOneTimePassword')
            ->willReturn($this->oneTimePasswordResponseTransferMock);

        $this->oneTimePasswordResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccess')
            ->willReturn(true);

        $this->assertInstanceOf(
            RestOneTimePasswordResponseTransfer::class,
            $this->oneTimePasswordRestApiSender->requestOneTimePassword(
                $this->restOneTimePasswordRequestAttributesTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testRequestLoginLink(): void
    {
        $this->restOneTimePasswordLoginLinkRequestAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getEmail')
            ->willReturn($this->email);

        $this->restOneTimePasswordLoginLinkRequestAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getOrderReference')
            ->willReturn($this->orderReference);

        $this->oneTimePasswordFacadeMock->expects($this->atLeastOnce())
            ->method('requestLoginLinkWithOrderReference')
            ->willReturn($this->oneTimePasswordResponseTransferMock);

        $this->oneTimePasswordResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccess')
            ->willReturn(true);

        $this->assertInstanceOf(
            RestOneTimePasswordResponseTransfer::class,
            $this->oneTimePasswordRestApiSender->requestLoginLink(
                $this->restOneTimePasswordLoginLinkRequestAttributesTransferMock
            )
        );
    }
}
