<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage;

use Codeception\Test\Unit;
use FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToLocaleClientInterface;
use FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToStorageClientInterface;
use FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Service\ProductLocaleRestrictionStorageToSynchronizationServiceInterface;
use Spryker\Client\Kernel\Container;
use Spryker\Client\Kernel\Locator;
use Spryker\Client\Locale\LocaleClientInterface;
use Spryker\Client\Storage\StorageClientInterface;
use Spryker\Service\Synchronization\SynchronizationServiceInterface;
use Spryker\Shared\Kernel\BundleProxy;

class ProductLocaleRestrictionStorageDependencyProviderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Locator
     */
    protected $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Locale\LocaleClientInterface
     */
    protected $localeClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Storage\StorageClientInterface
     */
    protected $storageClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Service\Synchronization\SynchronizationServiceInterface
     */
    protected $synchronizationServiceMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageDependencyProvider
     */
    protected $productLocaleRestrictionStorageDependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeClientMock = $this->getMockBuilder(LocaleClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storageClientMock = $this->getMockBuilder(StorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->synchronizationServiceMock = $this->getMockBuilder(SynchronizationServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionStorageDependencyProvider = new ProductLocaleRestrictionStorageDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideServiceLayerDependencies(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(
                ['locale'],
                ['storage'],
                ['synchronization'],
            )
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(
                ['client'],
                ['client'],
                ['service'],
            )
            ->willReturnOnConsecutiveCalls(
                $this->localeClientMock,
                $this->storageClientMock,
                $this->synchronizationServiceMock,
            );

        $container = $this->productLocaleRestrictionStorageDependencyProvider->provideServiceLayerDependencies(
            $this->containerMock,
        );

        static::assertInstanceOf(
            ProductLocaleRestrictionStorageToLocaleClientInterface::class,
            $container[ProductLocaleRestrictionStorageDependencyProvider::CLIENT_LOCALE],
        );

        static::assertInstanceOf(
            ProductLocaleRestrictionStorageToStorageClientInterface::class,
            $container[ProductLocaleRestrictionStorageDependencyProvider::CLIENT_STORAGE],
        );

        static::assertInstanceOf(
            ProductLocaleRestrictionStorageToSynchronizationServiceInterface::class,
            $container[ProductLocaleRestrictionStorageDependencyProvider::SERVICE_SYNCHRONIZATION],
        );

        static::assertEquals($container, $this->containerMock);
    }
}
