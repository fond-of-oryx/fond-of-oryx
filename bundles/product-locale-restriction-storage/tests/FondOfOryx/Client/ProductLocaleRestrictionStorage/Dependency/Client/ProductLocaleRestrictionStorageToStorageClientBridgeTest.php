<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client;

use Codeception\Test\Unit;
use Spryker\Client\Storage\StorageClientInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class ProductLocaleRestrictionStorageToStorageClientBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Storage\StorageClientInterface
     */
    protected $storageClientMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToStorageClientBridge
     */
    protected $productLocaleRestrictionStorageToStorageClientBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->storageClientMock = $this->getMockBuilder(StorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionStorageToStorageClientBridge = new ProductLocaleRestrictionStorageToStorageClientBridge(
            $this->storageClientMock,
        );
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $storageTransferMock = $this->getMockBuilder(AbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $key = 'foo';

        $this->storageClientMock->expects(static::atLeastOnce())
            ->method('get')
            ->with($key)
            ->willReturn($storageTransferMock);

        static::assertEquals(
            $storageTransferMock,
            $this->productLocaleRestrictionStorageToStorageClientBridge->get($key),
        );
    }

    /**
     * @return void
     */
    public function testGetMulti(): void
    {
        $storageTransferMocks = [
            $this->getMockBuilder(AbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock(),
        ];

        $keys = ['foo'];

        $this->storageClientMock->expects(static::atLeastOnce())
            ->method('getMulti')
            ->with($keys)
            ->willReturn($storageTransferMocks);

        static::assertEquals(
            $storageTransferMocks,
            $this->productLocaleRestrictionStorageToStorageClientBridge->getMulti($keys),
        );
    }
}
