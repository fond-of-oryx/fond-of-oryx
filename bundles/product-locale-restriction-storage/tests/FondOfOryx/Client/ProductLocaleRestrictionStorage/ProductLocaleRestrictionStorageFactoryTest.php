<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage;

use Codeception\Test\Unit;
use FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToLocaleClientInterface;
use FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToStorageClientInterface;
use FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Service\ProductLocaleRestrictionStorageToSynchronizationServiceInterface;
use FondOfOryx\Client\ProductLocaleRestrictionStorage\Model\ProductAbstractRestrictionReader;
use Spryker\Client\Kernel\Container;

class ProductLocaleRestrictionStorageFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToLocaleClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeClientMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToStorageClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storageClientMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Service\ProductLocaleRestrictionStorageToSynchronizationServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $synchronizationServiceMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageFactory
     */
    protected $productLocaleRestrictionStorageFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeClientMock = $this->getMockBuilder(ProductLocaleRestrictionStorageToLocaleClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storageClientMock = $this->getMockBuilder(ProductLocaleRestrictionStorageToStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->synchronizationServiceMock = $this->getMockBuilder(ProductLocaleRestrictionStorageToSynchronizationServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionStorageFactory = new ProductLocaleRestrictionStorageFactory();
        $this->productLocaleRestrictionStorageFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateProductAbstractRestrictionReader(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [ProductLocaleRestrictionStorageDependencyProvider::CLIENT_LOCALE],
                [ProductLocaleRestrictionStorageDependencyProvider::CLIENT_STORAGE],
                [ProductLocaleRestrictionStorageDependencyProvider::SERVICE_SYNCHRONIZATION]
            )->willReturnOnConsecutiveCalls(
                $this->localeClientMock,
                $this->storageClientMock,
                $this->synchronizationServiceMock
            );

        static::assertInstanceOf(
            ProductAbstractRestrictionReader::class,
            $this->productLocaleRestrictionStorageFactory->createProductAbstractRestrictionReader()
        );
    }
}
