<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckoutRestApiFacade;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckoutRestApiFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableCheckoutRestApiFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Communication\Controller\GatewayController
     */
    protected $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->splittableCheckoutRestApiFacadeMock = $this->getMockBuilder(SplittableCheckoutRestApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutRequestTransferMock = $this->getMockBuilder(RestSplittableCheckoutRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutResponseTransferMock = $this->getMockBuilder(RestSplittableCheckoutResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsResponseTransferMock = $this->getMockBuilder(RestSplittableTotalsResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new class ($this->splittableCheckoutRestApiFacadeMock) extends GatewayController {
            /**
             * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckoutRestApiFacadeInterface
             */
            protected $splittableCheckoutRestApiFacade;

            /**
             * @param \Spryker\Zed\Kernel\Business\AbstractFacade $facade
             */
            public function __construct(AbstractFacade $facade)
            {
                $this->splittableCheckoutRestApiFacade = $facade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
            {
                return $this->splittableCheckoutRestApiFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testPlaceOrderAction(): void
    {
        $this->splittableCheckoutRestApiFacadeMock->expects(static::atLeastOnce())
            ->method('placeOrder')
            ->with($this->restSplittableCheckoutRequestTransferMock)
            ->willReturn($this->restSplittableCheckoutResponseTransferMock);

        static::assertEquals(
            $this->restSplittableCheckoutResponseTransferMock,
            $this->gatewayController->placeOrderAction($this->restSplittableCheckoutRequestTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testGetSplittableTotalsAction(): void
    {
        $this->splittableCheckoutRestApiFacadeMock->expects(static::atLeastOnce())
            ->method('getSplittableTotals')
            ->with($this->restSplittableCheckoutRequestTransferMock)
            ->willReturn($this->restSplittableTotalsResponseTransferMock);

        static::assertEquals(
            $this->restSplittableTotalsResponseTransferMock,
            $this->gatewayController->getSplittableTotalsAction($this->restSplittableCheckoutRequestTransferMock)
        );
    }
}
