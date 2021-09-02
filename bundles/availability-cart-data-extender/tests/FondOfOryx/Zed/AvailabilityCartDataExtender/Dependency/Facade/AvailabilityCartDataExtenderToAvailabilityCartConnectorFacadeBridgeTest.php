<?php

namespace FondOfOryx\Zed\AvailabilityCartDataExtender\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;
use Spryker\Zed\AvailabilityCartConnector\Business\AvailabilityCartConnectorFacadeInterface;

class AvailabilityCartDataExtenderToAvailabilityCartConnectorFacadeBridgeTest extends Unit
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
     * @var \Spryker\Zed\AvailabilityCartConnector\Business\AvailabilityCartConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $availabilityCartConnectorFacadeMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityCartDataExtender\Dependency\Facade\AvailabilityCartDataExtenderToAvailabilityCartConnectorFacadeBridge
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
        $this->availabilityCartConnectorFacadeMock = $this->getMockBuilder(AvailabilityCartConnectorFacadeInterface::class)->disableOriginalConstructor()->getMock();

        $this->toTest = new AvailabilityCartDataExtenderToAvailabilityCartConnectorFacadeBridge($this->availabilityCartConnectorFacadeMock);
    }

    /**
     * @return void
     */
    public function testCheckCartAvailability(): void
    {
        $this->availabilityCartConnectorFacadeMock->expects(static::once())->method('checkCartAvailability')->willReturn($this->cartPreCheckResponseTransferMock);

        $this->toTest->checkCartAvailability($this->cartChangeTransferMock);
    }
}
