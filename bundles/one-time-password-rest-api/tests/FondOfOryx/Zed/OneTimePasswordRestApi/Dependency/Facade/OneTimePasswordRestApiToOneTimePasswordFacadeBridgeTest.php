<?php

namespace FondOfOryx\Zed\OneTimePasswordRestApi\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

class OneTimePasswordRestApiToOneTimePasswordFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePasswordRestApi\Dependency\Facade\OneTimePasswordRestApiToOneTimePasswordFacadeBridge
     */
    protected $oneTimePasswordRestApiToOneTimePasswordFacadeBridge;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\OneTimePasswordResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->oneTimePasswordFacadeMock = $this->getMockBuilder(OneTimePasswordFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordResponseTransferMock = $this->getMockBuilder(OneTimePasswordResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordRestApiToOneTimePasswordFacadeBridge = new OneTimePasswordRestApiToOneTimePasswordFacadeBridge(
            $this->oneTimePasswordFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testRequestOneTimePassword(): void
    {
        $this->oneTimePasswordFacadeMock->expects($this->atLeastOnce())
            ->method('requestOneTimePassword')
            ->with($this->customerTransferMock)
            ->willReturn($this->oneTimePasswordResponseTransferMock);

        $this->assertSame(
            $this->oneTimePasswordResponseTransferMock,
            $this->oneTimePasswordRestApiToOneTimePasswordFacadeBridge->requestOneTimePassword(
                $this->customerTransferMock
            )
        );
    }
}
