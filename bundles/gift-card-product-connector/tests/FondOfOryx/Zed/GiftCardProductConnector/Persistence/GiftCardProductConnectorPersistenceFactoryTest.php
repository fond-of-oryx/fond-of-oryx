<?php

namespace FondOfOryx\Zed\GiftCardProductConnector;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorPersistenceFactory;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductAbstractConfigurationLinkMapperInterface;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductAbstractConfigurationMapperInterface;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductConfigurationLinkMapperInterface;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductConfigurationMapperInterface;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationLinkQuery;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationQuery;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfigurationLinkQuery;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfigurationQuery;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\Product\Persistence\SpyProductQuery;
use Spryker\Zed\Kernel\Container;

class GiftCardProductConnectorPersistenceFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorPersistenceFactory
     */
    protected $giftCardProductConnectorPersistenceFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationQuery
     */
    protected $spyGiftCardProductAbstractConfigurationQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfigurationQuery
     */
    protected $spyGiftCardProductConfigurationQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationLinkQuery
     */
    protected $spyGiftCardProductAbstractConfigurationLinkQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfigurationLinkQuery
     */
    protected $spyGiftCardProductConfigurationLinkQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    protected $spyProductAbstractQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Product\Persistence\SpyProductQuery
     */
    protected $spyProductQueryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductAbstractConfigurationQueryMock = $this
            ->getMockBuilder(SpyGiftCardProductAbstractConfigurationQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductConfigurationQueryMock = $this->getMockBuilder(SpyGiftCardProductConfigurationQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductAbstractConfigurationLinkQueryMock = $this
            ->getMockBuilder(SpyGiftCardProductAbstractConfigurationLinkQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductConfigurationLinkQueryMock = $this
            ->getMockBuilder(SpyGiftCardProductConfigurationLinkQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyProductAbstractQueryMock = $this
            ->getMockBuilder(SpyProductAbstractQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyProductQueryMock = $this
            ->getMockBuilder(SpyProductQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardProductConnectorPersistenceFactory = new GiftCardProductConnectorPersistenceFactory();
        $this->giftCardProductConnectorPersistenceFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateSpyGiftCardProductAbstractConfigurationQuery(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_GIFT_CARD_PRODUCT_ABSTRACT_CONFIGURATION)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_GIFT_CARD_PRODUCT_ABSTRACT_CONFIGURATION)
            ->willReturn($this->spyGiftCardProductAbstractConfigurationQueryMock);

        $this->assertInstanceOf(
            SpyGiftCardProductAbstractConfigurationQuery::class,
            $this->giftCardProductConnectorPersistenceFactory->createSpyGiftCardProductAbstractConfigurationQuery(),
        );
    }

    /**
     * @return void
     */
    public function testCreateSpyGiftCardProductConfigurationQuery(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_GIFT_CARD_PRODUCT_CONFIGURATION)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_GIFT_CARD_PRODUCT_CONFIGURATION)
            ->willReturn($this->spyGiftCardProductConfigurationQueryMock);

        $this->assertInstanceOf(
            SpyGiftCardProductConfigurationQuery::class,
            $this->giftCardProductConnectorPersistenceFactory->createSpyGiftCardProductConfigurationQuery(),
        );
    }

    /**
     * @return void
     */
    public function testCreateSpyGiftCardProductAbstractConfigurationLinkQuery(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_GIFT_CARD_PRODUCT_ABSTRACT_CONFIGURATION_LINK)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_GIFT_CARD_PRODUCT_ABSTRACT_CONFIGURATION_LINK)
            ->willReturn($this->spyGiftCardProductAbstractConfigurationLinkQueryMock);

        $this->assertInstanceOf(
            SpyGiftCardProductAbstractConfigurationLinkQuery::class,
            $this->giftCardProductConnectorPersistenceFactory->createSpyGiftCardProductAbstractConfigurationLinkQuery(),
        );
    }

    /**
     * @return void
     */
    public function testCreateSpyGiftCardProductConfigurationLinkQuery(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_GIFT_CARD_PRODUCT_CONFIGURATION_LINK)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_GIFT_CARD_PRODUCT_CONFIGURATION_LINK)
            ->willReturn($this->spyGiftCardProductConfigurationLinkQueryMock);

        $this->assertInstanceOf(
            SpyGiftCardProductConfigurationLinkQuery::class,
            $this->giftCardProductConnectorPersistenceFactory->createSpyGiftCardProductConfigurationLinkQuery(),
        );
    }

    /**
     * @return void
     */
    public function testCreateGiftCardProductAbstractConfigurationMapper(): void
    {
        $this->assertInstanceOf(
            GiftCardProductAbstractConfigurationMapperInterface::class,
            $this->giftCardProductConnectorPersistenceFactory->createGiftCardProductAbstractConfigurationMapper(),
        );
    }

    /**
     * @return void
     */
    public function testCreateGiftCardProductAbstractConfigurationLinkMapper(): void
    {
        $this->assertInstanceOf(
            GiftCardProductAbstractConfigurationLinkMapperInterface::class,
            $this->giftCardProductConnectorPersistenceFactory->createGiftCardProductAbstractConfigurationLinkMapper(),
        );
    }

    /**
     * @return void
     */
    public function testCreateGiftCardProductConfigurationMapper(): void
    {
        $this->assertInstanceOf(
            GiftCardProductConfigurationMapperInterface::class,
            $this->giftCardProductConnectorPersistenceFactory->createGiftCardProductConfigurationMapper(),
        );
    }

    /**
     * @return void
     */
    public function testCreateGiftCardProductConfigurationLinkMapper(): void
    {
        $this->assertInstanceOf(
            GiftCardProductConfigurationLinkMapperInterface::class,
            $this->giftCardProductConnectorPersistenceFactory->createGiftCardProductConfigurationLinkMapper(),
        );
    }

    /**
     * @return void
     */
    public function testCreateProductAbstractQuery(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_PRODUCT_ABSTRACT)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_PRODUCT_ABSTRACT)
            ->willReturn($this->spyProductAbstractQueryMock);

        $this->assertInstanceOf(
            SpyProductAbstractQuery::class,
            $this->giftCardProductConnectorPersistenceFactory->createProductAbstractQuery(),
        );
    }

    /**
     * @return void
     */
    public function testCreateProductQuery(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_PRODUCT)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(GiftCardProductConnectorDependencyProvider::PROPEL_QUERY_PRODUCT)
            ->willReturn($this->spyProductQueryMock);

        $this->assertInstanceOf(
            SpyProductQuery::class,
            $this->giftCardProductConnectorPersistenceFactory->createProductQuery(),
        );
    }
}
