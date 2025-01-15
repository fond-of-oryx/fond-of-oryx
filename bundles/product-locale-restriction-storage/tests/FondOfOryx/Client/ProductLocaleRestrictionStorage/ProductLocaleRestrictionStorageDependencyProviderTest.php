<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage;

use Codeception\Test\Unit;
use Exception;
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

        $containerMock = $this->getMockBuilder(Container::class);

        /** @phpstan-ignore-next-line */
        if (method_exists($containerMock, 'setMethodsExcept')) {
            /** @phpstan-ignore-next-line */
            $containerMock->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet']);
        } else {
            /** @phpstan-ignore-next-line */
            $containerMock->onlyMethods(['getLocator'])->enableOriginalClone();
        }

        $this->containerMock = $containerMock->getMock();

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
        $self = $this;
        $this->containerMock->expects($this->atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects($this->atLeastOnce())
            ->method('__call')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case 'locale':
                        return $self->bundleProxyMock;
                    case 'storage':
                        return $self->bundleProxyMock;
                    case 'synchronization':
                        return $self->bundleProxyMock;
                }

                throw new Exception('Invalid key');
            });

        $callCount = $this->atLeastOnce();
        $this->bundleProxyMock->expects($callCount)
            ->method('__call')
            ->willReturnCallback(static function (string $key) use ($self, $callCount) {
                /** @phpstan-ignore-next-line */
                if (method_exists($callCount, 'getInvocationCount')) {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->getInvocationCount();
                } else {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->numberOfInvocations();
                }

                switch ($count) {
                    case 1:
                        $self->assertSame('client', $key);

                        return $self->localeClientMock;
                    case 2:
                        $self->assertSame('client', $key);

                        return $self->storageClientMock;
                    case 3:
                        $self->assertSame('service', $key);

                        return $self->synchronizationServiceMock;
                }

                throw new Exception('Unexpected call count');
            });

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
