<?php

namespace FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToOneTimePasswordFacadeBridge;
use FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordAttributesTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

class CustomerRegistrationOneTimePasswordConnectorToOneTimePasswordFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToOneTimePasswordFacadeBridge
     */
    protected $facade;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OneTimePasswordAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OneTimePasswordResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->facadeMock = $this->getMockBuilder(OneTimePasswordFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordAttributesTransferMock = $this->getMockBuilder(OneTimePasswordAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordResponseTransferMock = $this->getMockBuilder(OneTimePasswordResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CustomerRegistrationToOneTimePasswordFacadeBridge(
            $this->facadeMock,
        );
    }

    /**
     * @return void
     */
    public function testRequestLoginLink(): void
    {
        $this->facadeMock->expects(static::once())->method('requestLoginLink')->willReturn($this->oneTimePasswordResponseTransferMock);

        $this->facade->requestLoginLink(
            $this->customerTransferMock,
            $this->oneTimePasswordAttributesTransferMock,
        );
    }
}
