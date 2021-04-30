<?php

namespace FondOfOryx\Client\OneTimePasswordRestApi\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\OneTimePasswordRestApi\Dependency\Client\OneTimePasswordRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer;

class OneTimePasswordRestApiStubTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\OneTimePasswordRestApi\Zed\OneTimePasswordRestApiStub
     */
    protected $oneTimePasswordRestApiStub;

    /**
     * @var \FondOfOryx\Client\OneTimePasswordRestApi\Dependency\Client\OneTimePasswordRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restOneTimePasswordRequestAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restOneTimePasswordResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->zedRequestClientMock = $this->getMockBuilder(OneTimePasswordRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOneTimePasswordRequestAttributesTransferMock = $this->getMockBuilder(RestOneTimePasswordRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOneTimePasswordResponseTransferMock = $this->getMockBuilder(RestOneTimePasswordResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordRestApiStub = new OneTimePasswordRestApiStub(
            $this->zedRequestClientMock
        );
    }

    /**
     * @return void
     */
    public function testRequestOneTimePassword(): void
    {
        $this->zedRequestClientMock->expects($this->atLeastOnce())
            ->method('call')
            ->with(
                '/one-time-password-rest-api/gateway/request-one-time-password',
                $this->restOneTimePasswordRequestAttributesTransferMock
            )
            ->willReturn($this->restOneTimePasswordResponseTransferMock);

        $this->assertSame(
            $this->restOneTimePasswordResponseTransferMock,
            $this->oneTimePasswordRestApiStub->requestOneTimePassword(
                $this->restOneTimePasswordRequestAttributesTransferMock
            )
        );
    }
}
