<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApi\Business\ReturnLabelsRestApiFacade;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\RestReturnLabelResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Communication\Controller\GatewayController
     */
    protected $gatewayController;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Business\ReturnLabelsRestApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(ReturnLabelsRestApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelRequestTransferMock = $this->getMockBuilder(RestReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelResponseTransferMock = $this->getMockBuilder(RestReturnLabelResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new class ($this->facadeMock) extends GatewayController {
            /**
             * @param \Spryker\Zed\Kernel\Business\AbstractFacade $facade
             */
            public function __construct(AbstractFacade $facade)
            {
                $this->facade = $facade;
            }
        };
    }

    /**
     * @return void
     */
    public function testGenerateReturnLabelAction(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('generateReturnLabel')
            ->with($this->restReturnLabelRequestTransferMock)
            ->willReturn($this->restReturnLabelResponseTransferMock);

        static::assertEquals(
            $this->restReturnLabelResponseTransferMock,
            $this->gatewayController->generateReturnLabelAction($this->restReturnLabelRequestTransferMock),
        );
    }
}
