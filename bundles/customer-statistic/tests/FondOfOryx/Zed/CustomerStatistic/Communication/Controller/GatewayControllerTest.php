<?php

namespace FondOfOryx\Zed\CustomerStatistic\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerStatistic\Business\CustomerStatisticFacade;
use Generated\Shared\Transfer\CustomerStatisticResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Business\CustomerStatisticFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerStatisticFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerStatisticResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerStatisticResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Communication\Controller\GatewayController
     */
    protected $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerStatisticFacadeMock = $this->getMockBuilder(CustomerStatisticFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticResponseTransferMock = $this->getMockBuilder(CustomerStatisticResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        if (method_exists(GatewayController::class, 'setFacade')) {
            $this->gatewayController = new GatewayController();
            $this->gatewayController->setFacade($this->customerStatisticFacadeMock);
        } else {
            $this->gatewayController = new class ($this->customerStatisticFacadeMock) extends GatewayController {
                /**
                 * @var \FondOfOryx\Zed\CustomerStatistic\Business\CustomerStatisticFacade
                 */
                protected $customerStatisticFacade;

                /**
                 * @param \FondOfOryx\Zed\CustomerStatistic\Business\CustomerStatisticFacade $customerStatisticFacade
                 */
                public function __construct(CustomerStatisticFacade $customerStatisticFacade)
                {
                    $this->customerStatisticFacade = $customerStatisticFacade;
                }

                /**
                 * @return \Spryker\Zed\Kernel\Business\AbstractFacade
                 */
                protected function getFacade(): AbstractFacade
                {
                    return $this->customerStatisticFacade;
                }
            };
        }
    }

    /**
     * @return void
     */
    public function testIncrementLoginCountAction(): void
    {
        $this->customerStatisticFacadeMock->expects(static::atLeastOnce())
            ->method('incrementLoginCount')
            ->with($this->customerTransferMock)
            ->willReturn($this->customerStatisticResponseTransferMock);

        static::assertEquals(
            $this->customerStatisticResponseTransferMock,
            $this->gatewayController->incrementLoginCountAction($this->customerTransferMock),
        );
    }
}
