<?php

namespace FondOfOryx\Zed\GiftCardApi;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer\GiftCardApiToApiQueryBuilderContainerBridge;
use FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer\GiftCardApiToApiQueryContainerBridge;
use FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer\GiftCardApiToGiftCardQueryContainerBridge;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Api\Persistence\ApiQueryContainerInterface;
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
     * @var \Spryker\Zed\Api\Persistence\ApiQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiQueryContainerMock;

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

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiQueryContainerMock = $this->getMockBuilder(ApiQueryContainerInterface::class)
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
        $this->containerMock->expects(static::atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(
                ['apiQueryBuilder'],
                ['api'],
                ['giftCard'],
            )
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('queryContainer')
            ->willReturnOnConsecutiveCalls(
                $this->apiQueryBuilderQueryContainerMock,
                $this->apiQueryContainerMock,
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
            GiftCardApiToApiQueryContainerBridge::class,
            $container[GiftCardApiDependencyProvider::QUERY_CONTAINER_API],
        );

        static::assertInstanceOf(
            GiftCardApiToGiftCardQueryContainerBridge::class,
            $container[GiftCardApiDependencyProvider::QUERY_CONTAINER_GIFT_CARD],
        );
    }
}
