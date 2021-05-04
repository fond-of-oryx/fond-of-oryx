<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotalsRestApi\Business\SplittableTotalsRestApiFacade;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApi\Business\SplittableTotalsRestApiFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsRestApiFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApi\Communication\Controller\GatewayController
     */
    protected $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->splittableTotalsRestApiFacadeMock = $this->getMockBuilder(SplittableTotalsRestApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsRequestTransferMock = $this->getMockBuilder(RestSplittableTotalsRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsResponseTransferMock = $this->getMockBuilder(RestSplittableTotalsResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new class ($this->splittableTotalsRestApiFacadeMock) extends GatewayController {
            /**
             * @var \FondOfOryx\Zed\OneTimePasswordRestApi\Business\OneTimePasswordRestApiFacade
             */
            protected $splittableTotalsRestApiFacade;

            /**
             * @param \Spryker\Zed\Kernel\Business\AbstractFacade $facade
             */
            public function __construct(AbstractFacade $facade)
            {
                $this->splittableTotalsRestApiFacade = $facade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
            {
                return $this->splittableTotalsRestApiFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testGetSplittableTotalsAction(): void
    {
        $this->splittableTotalsRestApiFacadeMock->expects(static::atLeastOnce())
            ->method('getSplittableTotals')
            ->with($this->restSplittableTotalsRequestTransferMock)
            ->willReturn($this->restSplittableTotalsResponseTransferMock);

        static::assertEquals(
            $this->restSplittableTotalsResponseTransferMock,
            $this->gatewayController->getSplittableTotalsAction($this->restSplittableTotalsRequestTransferMock)
        );
    }
}
