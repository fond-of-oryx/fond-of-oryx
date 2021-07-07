<?php

namespace FondOfOryx\Zed\GiftCardProductConnector;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProductConnector\Dependency\Facade\GiftCardProductConnectorToProductFacadeInterface;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationLinkQuery;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationQuery;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfigurationLinkQuery;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfigurationQuery;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\Product\Persistence\SpyProductQuery;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;
use Spryker\Zed\Product\Business\ProductFacadeInterface;

class GiftCardProductConnectorDependencyProviderTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Locator
     */
    protected $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    protected $productFacadeMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorDependencyProvider
     */
    protected $giftCardProductConnectorDependencyProvider;

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

        $this->productFacadeMock = $this->getMockBuilder(ProductFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardProductConnectorDependencyProvider = new GiftCardProductConnectorDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['product'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturnOnConsecutiveCalls(
                $this->productFacadeMock
            );

        $container = $this->giftCardProductConnectorDependencyProvider
            ->provideBusinessLayerDependencies($this->containerMock);

        static::assertEquals($this->containerMock, $container);

        static::assertInstanceOf(
            GiftCardProductConnectorToProductFacadeInterface::class,
            $this->containerMock[GiftCardProductConnectorDependencyProvider::FACADE_PRODUCT]
        );
    }

    /**
     * @return void
     */
    public function testProvidePersistenceLayerDependencies(): void
    {
        $this->assertEquals(
            $this->containerMock,
            $this->giftCardProductConnectorDependencyProvider->providePersistenceLayerDependencies($this->containerMock)
        );

        $this->assertInstanceOf(
            SpyGiftCardProductAbstractConfigurationQuery::class,
            $this->containerMock[GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_GIFT_CARD_PRODUCT_ABSTRACT_CONFIGURATION]
        );

        $this->assertInstanceOf(
            SpyGiftCardProductAbstractConfigurationLinkQuery::class,
            $this->containerMock[GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_GIFT_CARD_PRODUCT_ABSTRACT_CONFIGURATION_LINK]
        );

        $this->assertInstanceOf(
            SpyGiftCardProductConfigurationQuery::class,
            $this->containerMock[GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_GIFT_CARD_PRODUCT_CONFIGURATION]
        );

        $this->assertInstanceOf(
            SpyGiftCardProductConfigurationLinkQuery::class,
            $this->containerMock[GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_GIFT_CARD_PRODUCT_CONFIGURATION_LINK]
        );

        $this->assertInstanceOf(
            SpyProductAbstractQuery::class,
            $this->containerMock[GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_PRODUCT_ABSTRACT]
        );

        $this->assertInstanceOf(
            SpyProductQuery::class,
            $this->containerMock[GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_PRODUCT]
        );
    }
}
