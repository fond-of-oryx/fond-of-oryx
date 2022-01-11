<?php

namespace FondOfOryx\Zed\Invoice\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\StoreTransfer;
use Spryker\Zed\Store\Business\StoreFacade;

class InvoiceToStoreFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Store\Business\StoreFacade
     */
    protected $storeFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\StoreTransfer
     */
    protected $storeTransferMock;

    /**
     * @var \FondOfOryx\Zed\Invoice\Dependency\Facade\InvoiceToStoreFacadeBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->storeFacadeMock = $this->getMockBuilder(StoreFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new InvoiceToStoreFacadeBridge($this->storeFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetCurrentStore(): void
    {
        $this->storeFacadeMock->expects(static::atLeastOnce())
            ->method('getCurrentStore')
            ->willReturn($this->storeTransferMock);

        static::assertEquals($this->storeTransferMock, $this->bridge->getCurrentStore());
    }
}
