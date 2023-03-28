<?php

namespace FondOfOryx\Zed\BusinessOnBehalfRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\BusinessOnBehalfRestApiFacade;
use Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer;
use Generated\Shared\Transfer\RestBusinessOnBehalfResponseTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class GatewayControllerTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\BusinessOnBehalfRestApiFacade&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|BusinessOnBehalfRestApiFacade $facadeMock;

    /**
     * @var (\Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RestBusinessOnBehalfRequestTransfer $restBusinessOnBehalfRequestTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\RestBusinessOnBehalfResponseTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RestBusinessOnBehalfResponseTransfer $restBusinessOnBehalfResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Communication\Controller\GatewayController
     */
    protected GatewayController $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(BusinessOnBehalfRestApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restBusinessOnBehalfRequestTransferMock = $this->getMockBuilder(RestBusinessOnBehalfRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restBusinessOnBehalfResponseTransferMock = $this->getMockBuilder(RestBusinessOnBehalfResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new class ($this->facadeMock) extends GatewayController {
            /**
             * @var \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected AbstractFacade $businessOnBehalfRestApiFacade;

            /**
             * @param \Spryker\Zed\Kernel\Business\AbstractFacade $businessOnBehalfRestApiFacade
             */
            public function __construct(AbstractFacade $businessOnBehalfRestApiFacade)
            {
                $this->businessOnBehalfRestApiFacade = $businessOnBehalfRestApiFacade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
            {
                return $this->businessOnBehalfRestApiFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testSetDefaultCompanyUserByRestBusinessOnBehalfRequestAction(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('setDefaultCompanyUserByRestBusinessOnBehalfRequest')
            ->with($this->restBusinessOnBehalfRequestTransferMock)
            ->willReturn($this->restBusinessOnBehalfResponseTransferMock);

        static::assertEquals(
            $this->restBusinessOnBehalfResponseTransferMock,
            $this->gatewayController->setDefaultCompanyUserByRestBusinessOnBehalfRequestAction(
                $this->restBusinessOnBehalfRequestTransferMock,
            ),
        );
    }
}
