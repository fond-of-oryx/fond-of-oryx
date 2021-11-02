<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacade;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;

class ThirtyFiveUpApiToThirtyFiveUpFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeBridge
     */
    protected $bridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpOrderTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->facadeMock = $this->getMockBuilder(ThirtyFiveUpFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->thirtyFiveUpOrderTransferMock = $this->getMockBuilder(ThirtyFiveUpOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new ThirtyFiveUpApiToThirtyFiveUpFacadeBridge(
            $this->facadeMock,
        );
    }

    /**
     * @return void
     */
    public function testUpdateThirtyFiveUpOrder(): void
    {
        $this->facadeMock->expects($this->once())
            ->method('updateThirtyFiveUpOrder')
            ->willReturn($this->thirtyFiveUpOrderTransferMock);

        $this->bridge->updateThirtyFiveUpOrder($this->thirtyFiveUpOrderTransferMock);
    }

    /**
     * @return void
     */
    public function testFindThirtyFiveUpOrderById(): void
    {
        $this->facadeMock->expects($this->once())
            ->method('findThirtyFiveUpOrderById')
            ->willReturn($this->thirtyFiveUpOrderTransferMock);

        $this->bridge->findThirtyFiveUpOrderById(1);
    }
}
