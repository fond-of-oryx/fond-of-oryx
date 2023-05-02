<?php

namespace FondOfOryx\Zed\FallbackLocaleMailProxy\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\StoreTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Store\Business\StoreFacadeInterface;

class FallbackLocaleMailProxyToStoreFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Zed\Store\Business\StoreFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected MockObject|StoreFacadeInterface $facadeMock;

    /**
     * @var (\Generated\Shared\Transfer\StoreTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|StoreTransfer $storeTransferMock;

    /**
     * @var \FondOfOryx\Zed\FallbackLocaleMailProxy\Dependency\Facade\FallbackLocaleMailProxyToStoreFacadeBridge
     */
    protected FallbackLocaleMailProxyToStoreFacadeBridge $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(StoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new FallbackLocaleMailProxyToStoreFacadeBridge(
            $this->facadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetStoreByName(): void
    {
        $storeName = 'STORE';

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('getStoreByName')
            ->with($storeName)
            ->willReturn($this->storeTransferMock);

        static::assertEquals(
            $this->storeTransferMock,
            $this->bridge->getStoreByName($storeName),
        );
    }

    /**
     * @return void
     */
    public function testGetCurrentStore(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('getCurrentStore')
            ->willReturn($this->storeTransferMock);

        static::assertEquals(
            $this->storeTransferMock,
            $this->bridge->getCurrentStore(),
        );
    }
}
