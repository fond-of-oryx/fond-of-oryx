<?php

namespace FondOfOryx\Zed\JellyfishThirtyFiveUp\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacade;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrder;

class JellyfishThirtyFiveUpToThirtyFiveUpFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishThirtyFiveUp\Dependency\Facade\JellyfishThirtyFiveUpToThirtyFiveUpFacadeBridge
     */
    protected $bridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface
     */
    protected $facadeMock;

    /**
     * @var \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpOrderMock;

    /**
     * @var \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->facadeMock = $this->getMockBuilder(ThirtyFiveUpFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->thirtyFiveUpOrderMock = $this->getMockBuilder(ThirtyFiveUpOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderTransferMock = $this->getMockBuilder(ThirtyFiveUpOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new JellyfishThirtyFiveUpToThirtyFiveUpFacadeBridge(
            $this->facadeMock
        );
    }

    /**
     * @return void
     */
    public function testConvertThirtyFiveUpOrderEntityToTransfer(): void
    {
        $this->facadeMock->expects($this->once())
            ->method('convertThirtyFiveUpOrderEntityToTransfer')
            ->willReturn($this->orderTransferMock);

        $this->bridge->convertThirtyFiveUpOrderEntityToTransfer($this->thirtyFiveUpOrderMock);
    }
}
