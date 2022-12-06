<?php

namespace FondOfOryx\Zed\CustomerRegistration\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\StoreTransfer;
use Spryker\Zed\Store\Business\StoreFacadeInterface;

class CustomerRegistrationToStoreFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToStoreFacadeInterface
     */
    protected $facade;

    /**
     * @var \Spryker\Zed\Store\Business\StoreFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\StoreTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->storeFacadeMock = $this->getMockBuilder(StoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CustomerRegistrationToStoreFacadeBridge(
            $this->storeFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetCustomer(): void
    {
        $this->storeFacadeMock->expects(static::atLeastOnce())->method('getCurrentStore')->willReturn($this->storeTransferMock);

        $this->facade->getCurrentStore();
    }
}
