<?php

namespace FondOfOryx\Zed\AvailabilityCartDataExtender\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityCartDataExtender\Business\AvailabilityCartDataExtenderFacade;
use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class CheckAvailabilityPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CartPreCheckResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $cartPreCheckResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CartChangeTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $cartChangeTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityCartDataExtender\Business\AvailabilityCartDataExtenderFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityCartDataExtender\Communication\Plugin\CheckAvailabilityPlugin
     */
    protected $toTest;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->cartPreCheckResponseTransferMock = $this->getMockBuilder(CartPreCheckResponseTransfer::class)->disableOriginalConstructor()->getMock();
        $this->cartChangeTransferMock = $this->getMockBuilder(CartChangeTransfer::class)->disableOriginalConstructor()->getMock();
        $this->facadeMock = $this->getMockBuilder(AvailabilityCartDataExtenderFacade::class)->disableOriginalConstructor()->getMock();

        $this->toTest = new class ($this->facadeMock) extends CheckAvailabilityPlugin {
            /**
             * @var \FondOfOryx\Zed\AvailabilityCartDataExtender\Business\AvailabilityCartDataExtenderFacade
             */
            protected $facadeMock;

            /**
             * @param \FondOfOryx\Zed\AvailabilityCartDataExtender\Business\AvailabilityCartDataExtenderFacade $facadeMock
             */
            public function __construct(AvailabilityCartDataExtenderFacade $facadeMock)
            {
                $this->facadeMock = $facadeMock;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
            {
                return $this->facadeMock;
            }
        };
    }

    /**
     * @return void
     */
    public function testCheck(): void
    {
        $this->facadeMock->expects(static::once())->method('checkCartAvailability')->willReturn($this->cartPreCheckResponseTransferMock);

        $this->toTest->check($this->cartChangeTransferMock);
    }
}
