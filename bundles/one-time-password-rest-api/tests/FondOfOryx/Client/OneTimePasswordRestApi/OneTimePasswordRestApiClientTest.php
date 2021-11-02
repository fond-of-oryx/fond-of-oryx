<?php

namespace FondOfOryx\Client\OneTimePasswordRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\OneTimePasswordRestApi\Zed\OneTimePasswordRestApiStubInterface;
use Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer;

class OneTimePasswordRestApiClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\OneTimePasswordRestApi\OneTimePasswordRestApiClient
     */
    protected $oneTimePasswordRestApiClient;

    /**
     * @var \FondOfOryx\Client\OneTimePasswordRestApi\OneTimePasswordRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordRestApiFactoryMock;

    /**
     * @var \FondOfOryx\Client\OneTimePasswordRestApi\Zed\OneTimePasswordRestApiStubInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordRestApiStubMock;

    /**
     * @var \Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restOneTimePasswordRequestAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restOneTimePasswordResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restOneTimePasswordLoginLinkRequestAttributesTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->oneTimePasswordRestApiFactoryMock = $this->getMockBuilder(OneTimePasswordRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordRestApiStubMock = $this->getMockBuilder(OneTimePasswordRestApiStubInterface::class)
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

        $this->oneTimePasswordRestApiClient = new OneTimePasswordRestApiClient();
        $this->oneTimePasswordRestApiClient->setFactory($this->oneTimePasswordRestApiFactoryMock);
    }

    /**
     * @return void
     */
    public function testRequestOneTimePassword(): void
    {
        $this->oneTimePasswordRestApiFactoryMock->expects($this->atLeastOnce())
            ->method('createOneTimePasswordZedStub')
            ->willReturn($this->oneTimePasswordRestApiStubMock);

        $this->oneTimePasswordRestApiStubMock->expects($this->atLeastOnce())
            ->method('requestOneTimePassword')
            ->with($this->restOneTimePasswordRequestAttributesTransferMock)
            ->willReturn($this->restOneTimePasswordResponseTransferMock);

        $this->assertSame(
            $this->restOneTimePasswordResponseTransferMock,
            $this->oneTimePasswordRestApiClient->requestOneTimePassword(
                $this->restOneTimePasswordRequestAttributesTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testRequestOneTimePasswordLoginLink(): void
    {
        $this->oneTimePasswordRestApiFactoryMock->expects($this->atLeastOnce())
            ->method('createOneTimePasswordZedStub')
            ->willReturn($this->oneTimePasswordRestApiStubMock);

        $this->oneTimePasswordRestApiStubMock->expects($this->atLeastOnce())
            ->method('requestOneTimePasswordLoginLink')
            ->with($this->restOneTimePasswordLoginLinkRequestAttributesTransferMock)
            ->willReturn($this->restOneTimePasswordResponseTransferMock);

        $this->assertSame(
            $this->restOneTimePasswordResponseTransferMock,
            $this->oneTimePasswordRestApiClient->requestOneTimePasswordLoginLink(
                $this->restOneTimePasswordLoginLinkRequestAttributesTransferMock,
            ),
        );
    }
}
