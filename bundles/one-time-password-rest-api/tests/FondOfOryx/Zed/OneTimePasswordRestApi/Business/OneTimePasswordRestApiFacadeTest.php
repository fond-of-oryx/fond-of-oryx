<?php

namespace FondOfOryx\Zed\OneTimePasswordRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePasswordRestApi\Business\Sender\OneTimePasswordRestApiSenderInterface;
use Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer;

class OneTimePasswordRestApiFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePasswordRestApi\Business\OneTimePasswordRestApiFacade
     */
    protected $oneTimePasswordRestApiFacade;

    /**
     * @var \FondOfOryx\Zed\OneTimePasswordRestApi\Business\OneTimePasswordRestApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordRestApiBusinessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePasswordRestApi\Business\Sender\OneTimePasswordRestApiSenderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordRestApiSenderMock;

    /**
     * @var \Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restOneTimePasswordRequestAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restOneTimePasswordResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restOneTimePasswordLoginLinkRequestAttributesTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->oneTimePasswordRestApiBusinessFactoryMock = $this->getMockBuilder(OneTimePasswordRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordRestApiSenderMock = $this->getMockBuilder(OneTimePasswordRestApiSenderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOneTimePasswordRequestAttributesTransferMock = $this->getMockBuilder(RestOneTimePasswordRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOneTimePasswordResponseTransferMock = $this->getMockBuilder(RestOneTimePasswordResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOneTimePasswordLoginLinkRequestAttributesTransferMock = $this->getMockBuilder(RestOneTimePasswordLoginLinkRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordRestApiFacade = new OneTimePasswordRestApiFacade();
        $this->oneTimePasswordRestApiFacade->setFactory($this->oneTimePasswordRestApiBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testRequestOneTimePassword(): void
    {
        $this->oneTimePasswordRestApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createOneTimePasswordRestApiSender')
            ->willReturn($this->oneTimePasswordRestApiSenderMock);

        $this->oneTimePasswordRestApiSenderMock->expects($this->atLeastOnce())
            ->method('requestOneTimePassword')
            ->with($this->restOneTimePasswordRequestAttributesTransferMock)
            ->willReturn($this->restOneTimePasswordResponseTransferMock);

        $this->assertSame(
            $this->restOneTimePasswordResponseTransferMock,
            $this->oneTimePasswordRestApiFacade->requestOneTimePassword(
                $this->restOneTimePasswordRequestAttributesTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testRequestLoginLink(): void
    {
        $this->oneTimePasswordRestApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createOneTimePasswordRestApiSender')
            ->willReturn($this->oneTimePasswordRestApiSenderMock);

        $this->oneTimePasswordRestApiSenderMock->expects($this->atLeastOnce())
            ->method('requestLoginLink')
            ->with($this->restOneTimePasswordLoginLinkRequestAttributesTransferMock)
            ->willReturn($this->restOneTimePasswordResponseTransferMock);

        $this->assertSame(
            $this->restOneTimePasswordResponseTransferMock,
            $this->oneTimePasswordRestApiFacade->requestLoginLink(
                $this->restOneTimePasswordLoginLinkRequestAttributesTransferMock
            )
        );
    }
}
