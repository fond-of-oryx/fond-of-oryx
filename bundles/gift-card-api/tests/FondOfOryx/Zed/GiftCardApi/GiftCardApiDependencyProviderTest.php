<?php

namespace FondOfOryx\Zed\GiftCardApi;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\GiftCardApi\Dependency\Facade\GiftCardApiToApiFacadeBridge;
use FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer\GiftCardApiToApiQueryBuilderContainerBridge;
use FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer\GiftCardApiToGiftCardQueryContainerBridge;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Api\Business\ApiFacadeInterface;
use Spryker\Zed\ApiQueryBuilder\Persistence\ApiQueryBuilderQueryContainerInterface;
use Spryker\Zed\GiftCard\Persistence\GiftCardQueryContainerInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class GiftCardApiDependencyProviderTest extends Unit
{
    /**
     * @var \Spryker\Zed\ApiQueryBuilder\Persistence\ApiQueryBuilderQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiQueryBuilderQueryContainerMock;

    /**
     * @var \Spryker\Zed\Api\Business\ApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiFacadeMock;

    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $containerMock;

    /**
     * @var \Spryker\Zed\GiftCard\Persistence\GiftCardQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $giftCardQueryContainerMock;

    /**
     * @var \Spryker\Zed\Kernel\Locator|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $locatorMock;

    /**
     * @var \Spryker\Shared\Kernel\BundleProxy|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $bundleProxyMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardApi\GiftCardApiDependencyProvider
     */
    protected $dependencyProvider;

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

        $this->apiFacadeMock = $this->getMockBuilder(ApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiQueryBuilderQueryContainerMock = $this->getMockBuilder(ApiQueryBuilderQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardQueryContainerMock = $this->getMockBuilder(GiftCardQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyProvider = new GiftCardApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvidePersistenceLayerDependencies(): void
    {
        $self = $this;
        $this->containerMock->expects($this->atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects($this->atLeastOnce())
            ->method('__call')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case 'apiQueryBuilder':
                        return $self->bundleProxyMock;
                    case 'api':
                        return $self->bundleProxyMock;
                    case 'giftCard':
                        return $self->bundleProxyMock;
                }

                throw new Exception('Invalid key');
            });

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->willReturnOnConsecutiveCalls(
                $this->apiQueryBuilderQueryContainerMock,
                $this->apiFacadeMock,
                $this->giftCardQueryContainerMock,
            );

        $container = $this->dependencyProvider
            ->providePersistenceLayerDependencies($this->containerMock);

        static::assertEquals($this->containerMock, $container);

        static::assertInstanceOf(
            GiftCardApiToApiQueryBuilderContainerBridge::class,
            $container[GiftCardApiDependencyProvider::QUERY_BUILDER_CONTAINER_API],
        );

        static::assertInstanceOf(
            GiftCardApiToApiFacadeBridge::class,
            $container[GiftCardApiDependencyProvider::FACADE_API],
        );

        static::assertInstanceOf(
            GiftCardApiToGiftCardQueryContainerBridge::class,
            $container[GiftCardApiDependencyProvider::QUERY_CONTAINER_GIFT_CARD],
        );
    }
}
