<?php

namespace FondOfOryx\Zed\OneTimePasswordRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePasswordRestApi\Business\OneTimePasswordRestApiFacade;
use FondOfOryx\Zed\OneTimePasswordRestApi\Business\OneTimePasswordRestApiFacadeInterface;
use Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePasswordRestApi\Communication\Controller\GatewayController
     */
    protected $gatewayController;

    /**
     * @var \FondOfOryx\Zed\OneTimePasswordRestApi\Business\OneTimePasswordRestApiFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordRestApiFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestOneTimePasswordResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restOneTimePasswordResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restOneTimePasswordRequestAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restOneTimePasswordLoginLinkRequestAttributesTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->oneTimePasswordRestApiFacadeMock = $this->getMockBuilder(OneTimePasswordRestApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOneTimePasswordResponseTransferMock = $this->getMockBuilder(RestOneTimePasswordResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOneTimePasswordRequestAttributesTransferMock = $this->getMockBuilder(RestOneTimePasswordRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOneTimePasswordLoginLinkRequestAttributesTransferMock = $this->getMockBuilder(RestOneTimePasswordLoginLinkRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new class ($this->oneTimePasswordRestApiFacadeMock) extends GatewayController {
            /**
             * @var \FondOfOryx\Zed\OneTimePasswordRestApi\Business\OneTimePasswordRestApiFacade
             */
            protected $oneTimePasswordRestApiFacade;

            /**
             * @param \FondOfOryx\Zed\OneTimePasswordRestApi\Business\OneTimePasswordRestApiFacade $oneTimePasswordRestApiFacade
             */
            public function __construct(OneTimePasswordRestApiFacade $oneTimePasswordRestApiFacade)
            {
                $this->oneTimePasswordRestApiFacade = $oneTimePasswordRestApiFacade;
            }

            /**
             * @return \FondOfOryx\Zed\OneTimePasswordRestApi\Business\OneTimePasswordRestApiFacadeInterface
             */
            public function getFacade(): OneTimePasswordRestApiFacadeInterface
            {
                return $this->oneTimePasswordRestApiFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testRequestOneTimePasswordAction(): void
    {
        $this->oneTimePasswordRestApiFacadeMock->expects($this->atLeastOnce())
            ->method('requestOneTimePassword')
            ->with($this->restOneTimePasswordRequestAttributesTransferMock)
            ->willReturn($this->restOneTimePasswordResponseTransferMock);

        $this->assertSame(
            $this->restOneTimePasswordResponseTransferMock,
            $this->gatewayController->requestOneTimePasswordAction(
                $this->restOneTimePasswordRequestAttributesTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testRequestOneTimePasswordLoginLinkAction(): void
    {
        $this->oneTimePasswordRestApiFacadeMock->expects($this->atLeastOnce())
            ->method('requestLoginLink')
            ->with($this->restOneTimePasswordLoginLinkRequestAttributesTransferMock)
            ->willReturn($this->restOneTimePasswordResponseTransferMock);

        $this->assertSame(
            $this->restOneTimePasswordResponseTransferMock,
            $this->gatewayController->requestOneTimePasswordLoginLinkAction(
                $this->restOneTimePasswordLoginLinkRequestAttributesTransferMock,
            ),
        );
    }
}
