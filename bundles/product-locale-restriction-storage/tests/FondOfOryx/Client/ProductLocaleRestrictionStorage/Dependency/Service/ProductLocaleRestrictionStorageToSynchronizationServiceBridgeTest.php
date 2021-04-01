<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Service;

use Codeception\Test\Unit;
use Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface;
use Spryker\Service\Synchronization\SynchronizationServiceInterface;

class ProductLocaleRestrictionStorageToSynchronizationServiceBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Service\Synchronization\SynchronizationServiceInterface
     */
    protected $synchronizationServiceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface
     */
    protected $synchronizationKeyGeneratorPluginMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Service\ProductLocaleRestrictionStorageToSynchronizationServiceBridge
     */
    protected $productLocaleRestrictionStorageToSynchronizationServiceBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->synchronizationServiceMock = $this->getMockBuilder(SynchronizationServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->synchronizationKeyGeneratorPluginMock = $this->getMockBuilder(SynchronizationKeyGeneratorPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionStorageToSynchronizationServiceBridge = new ProductLocaleRestrictionStorageToSynchronizationServiceBridge(
            $this->synchronizationServiceMock
        );
    }

    /**
     * @return void
     */
    public function testGetStorageKeyBuilder(): void
    {
        $resourceName = 'foo';

        $this->synchronizationServiceMock->expects(static::atLeastOnce())
            ->method('getStorageKeyBuilder')
            ->with($resourceName)
            ->willReturn($this->synchronizationKeyGeneratorPluginMock);

        static::assertEquals(
            $this->synchronizationKeyGeneratorPluginMock,
            $this->productLocaleRestrictionStorageToSynchronizationServiceBridge->getStorageKeyBuilder($resourceName)
        );
    }
}
