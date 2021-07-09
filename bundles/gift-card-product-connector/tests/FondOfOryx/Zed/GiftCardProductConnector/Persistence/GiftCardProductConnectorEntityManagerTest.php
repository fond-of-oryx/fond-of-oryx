<?php

namespace FondOfOryx\Zed\GiftCardProductConnector;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorEntityManager;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorPersistenceFactory;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductAbstractConfigurationLinkMapperInterface;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductAbstractConfigurationMapperInterface;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductConfigurationLinkMapperInterface;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductConfigurationMapperInterface;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer;
use Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationLinkEntityTransfer;
use Generated\Shared\Transfer\SpyGiftCardProductConfigurationEntityTransfer;
use Generated\Shared\Transfer\SpyGiftCardProductConfigurationLinkEntityTransfer;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfiguration;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationLink;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationLinkQuery;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationQuery;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfiguration;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfigurationLink;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfigurationLinkQuery;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfigurationQuery;
use Orm\Zed\Product\Persistence\SpyProduct;
use Orm\Zed\Product\Persistence\SpyProductAbstract;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\Product\Persistence\SpyProductQuery;

class GiftCardProductConnectorEntityManagerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorEntityManagerInterface
     */
    protected $giftCardProductConnectorEntityManager;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorPersistenceFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $giftCardProductProductConnectorPersistenceFactoryMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductAbstractConfigurationLinkMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $giftCardProductAbstractConfigurationLinkMapperMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductConfigurationLinkMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $giftCardProductConfigurationLinkMapperMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductAbstractConfigurationMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $giftCardProductAbstractConfigurationMapperMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductConfigurationMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $giftCardProductConfigurationMapperMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductAbstractConfigurationMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyGiftCardProductAbstractConfigurationQueryMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductConfigurationMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyGiftCardProductConfigurationQueryMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductAbstractConfigurationLinkMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyGiftCardProductAbstractConfigurationLinkQueryMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductConfigurationLinkMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyGiftCardProductConfigurationLinkQueryMock;

    /**
     * @var \Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationLink|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyGiftCardProductAbstractConfigurationLinkMock;

    /**
     * @var \Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyGiftCardProductAbstractConfigurationEntityTransferMock;

    /**
     * @var \Generated\Shared\Transfer\SpyGiftCardProductConfigurationEntityTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyGiftCardProductConfigurationEntityTransferMock;

    /**
     * @var \Generated\Shared\Transfer\SpyGiftCardProductConfigurationLinkEntityTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyGiftCardProductConfigurationLinkEntityTransferMock;

    /**
     * @var \Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationLinkEntityTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyGiftCardProductAbstractConfigurationLinkEntityTransferMock;

    /**
     * @var \Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfiguration|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyGiftCardProductAbstractConfigurationMock;

    /**
     * @var \Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfiguration|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyGiftCardProductConfigurationMock;

    /**
     * @var \Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfigurationLink|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyGiftCardProductConfigurationLinkMock;

    /**
     * @var \Orm\Zed\Product\Persistence\SpyProduct|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productMock;

    /**
     * @var \Orm\Zed\Product\Persistence\SpyProductAbstractQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractQueryMock;

    /**
     * @var \Orm\Zed\Product\Persistence\SpyProductQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productQueryMock;

    /**
     * @var \Orm\Zed\Product\Persistence\SpyProductAbstract|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractMock;

    /**
     * @var \Generated\Shared\Transfer\ProductAbstractTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductConcreteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productConcreteTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->giftCardProductProductConnectorPersistenceFactoryMock = $this
            ->getMockBuilder(GiftCardProductConnectorPersistenceFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductAbstractConfigurationQueryMock = $this
            ->getMockBuilder(SpyGiftCardProductAbstractConfigurationQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductConfigurationQueryMock = $this
            ->getMockBuilder(SpyGiftCardProductConfigurationQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardProductAbstractConfigurationMapperMock = $this
            ->getMockBuilder(GiftCardProductAbstractConfigurationMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardProductConfigurationMapperMock = $this
            ->getMockBuilder(GiftCardProductConfigurationMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardProductAbstractConfigurationLinkMapperMock = $this
            ->getMockBuilder(GiftCardProductAbstractConfigurationLinkMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardProductConfigurationLinkMapperMock = $this
            ->getMockBuilder(GiftCardProductConfigurationLinkMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductAbstractConfigurationEntityTransferMock = $this
            ->getMockBuilder(SpyGiftCardProductAbstractConfigurationEntityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductConfigurationEntityTransferMock = $this
            ->getMockBuilder(SpyGiftCardProductConfigurationEntityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductConfigurationLinkEntityTransferMock = $this
            ->getMockBuilder(SpyGiftCardProductConfigurationLinkEntityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductAbstractConfigurationLinkEntityTransferMock = $this
            ->getMockBuilder(SpyGiftCardProductAbstractConfigurationLinkEntityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductAbstractConfigurationMock = $this
            ->getMockBuilder(SpyGiftCardProductAbstractConfiguration::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductConfigurationMock = $this
            ->getMockBuilder(SpyGiftCardProductConfiguration::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductConfigurationLinkQueryMock = $this
            ->getMockBuilder(SpyGiftCardProductConfigurationLinkQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductAbstractConfigurationLinkQueryMock = $this
            ->getMockBuilder(SpyGiftCardProductAbstractConfigurationLinkQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductAbstractConfigurationLinkMock = $this
            ->getMockBuilder(SpyGiftCardProductAbstractConfigurationLink::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductConfigurationLinkMock = $this
            ->getMockBuilder(SpyGiftCardProductConfigurationLink::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractQueryMock = $this->getMockBuilder(SpyProductAbstractQuery::class)
            ->disableOriginalConstructor()
            ->addMethods(['findOneBySku'])
            ->getMock();

        $this->productQueryMock = $this->getMockBuilder(SpyProductQuery::class)
            ->disableOriginalConstructor()
            ->addMethods(['findOneBySku'])
            ->getMock();

        $this->productMock = $this->getMockBuilder(SpyProduct::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractMock = $this->getMockBuilder(SpyProductAbstract::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this
            ->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productConcreteTransferMock = $this
            ->getMockBuilder(ProductConcreteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardProductConnectorEntityManager = new GiftCardProductConnectorEntityManager();
        $this->giftCardProductConnectorEntityManager->setFactory($this->giftCardProductProductConnectorPersistenceFactoryMock);
    }

    /**
     * @return void
     */
    public function testsaveGiftCardProductAbstractConfiguration(): void
    {
        $pattern = '{randomPart}';
        $sku = 'sku';
        $idProductAbstract = 1;

        $this->giftCardProductProductConnectorPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('createSpyGiftCardProductAbstractConfigurationQuery')
            ->willReturn($this->spyGiftCardProductAbstractConfigurationQueryMock);

        $this->spyGiftCardProductAbstractConfigurationQueryMock->expects(static::atLeastOnce())
            ->method('filterByCodePattern')
            ->with($pattern)
            ->willReturn($this->spyGiftCardProductAbstractConfigurationQueryMock);

        $this->spyGiftCardProductAbstractConfigurationQueryMock->expects(static::atLeastOnce())
            ->method('findOneOrCreate')
            ->willReturn($this->spyGiftCardProductAbstractConfigurationMock);

        $this->spyGiftCardProductAbstractConfigurationMock->expects(static::atLeastOnce())
            ->method('save')
            ->willReturn(1);

        $this->giftCardProductProductConnectorPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('createGiftCardProductAbstractConfigurationMapper')
            ->willReturn($this->giftCardProductAbstractConfigurationMapperMock);

        $this->giftCardProductAbstractConfigurationMapperMock->expects(static::atLeastOnce())
            ->method('mapEntityToTransfer')
            ->with($this->spyGiftCardProductAbstractConfigurationMock)
            ->willReturn($this->spyGiftCardProductAbstractConfigurationEntityTransferMock);

        $this->spyGiftCardProductAbstractConfigurationEntityTransferMock->expects(static::atLeastOnce())
            ->method('addSpyGiftCardProductAbstractConfigurationLinks')
            ->willReturn($this->spyGiftCardProductAbstractConfigurationEntityTransferMock);

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($sku);

        $this->giftCardProductProductConnectorPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('createProductAbstractQuery')
            ->willReturn($this->productAbstractQueryMock);

        $this->productAbstractQueryMock->expects(static::atLeastOnce())
            ->method('findOneBySku')
            ->willReturn($this->productAbstractMock);

        $this->giftCardProductProductConnectorPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('createSpyGiftCardProductAbstractConfigurationLinkQuery')
            ->willReturn($this->spyGiftCardProductAbstractConfigurationLinkQueryMock);

        $this->spyGiftCardProductAbstractConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('filterByFkProductAbstract')
            ->with($idProductAbstract)
            ->willReturn($this->spyGiftCardProductAbstractConfigurationLinkQueryMock);

        $this->spyGiftCardProductAbstractConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('findOne')
            ->willReturn(null);

        $this->spyGiftCardProductAbstractConfigurationEntityTransferMock->expects(static::atLeastOnce())
            ->method('getIdGiftCardProductAbstractConfiguration')
            ->willReturn(1);

        $this->productAbstractMock->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn(1);

        $this->spyGiftCardProductAbstractConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('filterByFkGiftCardProductAbstractConfiguration')
            ->with(1)
            ->willReturn($this->spyGiftCardProductAbstractConfigurationLinkQueryMock);

        $this->spyGiftCardProductAbstractConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('filterByFkProductAbstract')
            ->with(1)
            ->willReturn($this->spyGiftCardProductAbstractConfigurationLinkQueryMock);

        $this->spyGiftCardProductAbstractConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('findOneOrCreate')
            ->willReturn($this->spyGiftCardProductAbstractConfigurationLinkMock);

        $this->spyGiftCardProductAbstractConfigurationLinkMock->expects(static::atLeastOnce())
            ->method('save')
            ->willReturn(1);

        $this->giftCardProductProductConnectorPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('createGiftCardProductAbstractConfigurationLinkMapper')
            ->willReturn($this->giftCardProductAbstractConfigurationLinkMapperMock);

        $this->giftCardProductAbstractConfigurationLinkMapperMock->expects(static::atLeastOnce())
            ->method('mapEntityToTransfer')
            ->willReturn($this->spyGiftCardProductAbstractConfigurationLinkEntityTransferMock);

        $entityTransfer = $this->giftCardProductConnectorEntityManager->saveGiftCardProductAbstractConfiguration(
            $this->productAbstractTransferMock,
            $pattern
        );

        $this->assertInstanceOf(SpyGiftCardProductAbstractConfigurationEntityTransfer::class, $entityTransfer);
        $this->assertEquals(
            $this->spyGiftCardProductAbstractConfigurationEntityTransferMock,
            $entityTransfer
        );

        $this->assertEquals($entityTransfer->getIdGiftCardProductAbstractConfiguration(), 1);
    }

    /**
     * @return void
     */
    public function testsaveGiftCardProductAbstractConfigurationAndDeleteConfigurationLinks(): void
    {
        $pattern = '{randomPart}';
        $sku = 'sku';
        $idProductAbstract = 1;

        $this->giftCardProductProductConnectorPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('createSpyGiftCardProductAbstractConfigurationQuery')
            ->willReturn($this->spyGiftCardProductAbstractConfigurationQueryMock);

        $this->spyGiftCardProductAbstractConfigurationQueryMock->expects(static::atLeastOnce())
            ->method('filterByCodePattern')
            ->with($pattern)
            ->willReturn($this->spyGiftCardProductAbstractConfigurationQueryMock);

        $this->spyGiftCardProductAbstractConfigurationQueryMock->expects(static::atLeastOnce())
            ->method('findOneOrCreate')
            ->willReturn($this->spyGiftCardProductAbstractConfigurationMock);

        $this->spyGiftCardProductAbstractConfigurationMock->expects(static::atLeastOnce())
            ->method('save')
            ->willReturn(1);

        $this->giftCardProductProductConnectorPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('createGiftCardProductAbstractConfigurationMapper')
            ->willReturn($this->giftCardProductAbstractConfigurationMapperMock);

        $this->giftCardProductAbstractConfigurationMapperMock->expects(static::atLeastOnce())
            ->method('mapEntityToTransfer')
            ->with($this->spyGiftCardProductAbstractConfigurationMock)
            ->willReturn($this->spyGiftCardProductAbstractConfigurationEntityTransferMock);

        $this->spyGiftCardProductAbstractConfigurationEntityTransferMock->expects(static::atLeastOnce())
            ->method('addSpyGiftCardProductAbstractConfigurationLinks')
            ->willReturn($this->spyGiftCardProductAbstractConfigurationEntityTransferMock);

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($sku);

        $this->giftCardProductProductConnectorPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('createProductAbstractQuery')
            ->willReturn($this->productAbstractQueryMock);

        $this->productAbstractQueryMock->expects(static::atLeastOnce())
            ->method('findOneBySku')
            ->willReturn($this->productAbstractMock);

        $this->giftCardProductProductConnectorPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('createSpyGiftCardProductAbstractConfigurationLinkQuery')
            ->willReturn($this->spyGiftCardProductAbstractConfigurationLinkQueryMock);

        $this->spyGiftCardProductAbstractConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('filterByFkProductAbstract')
            ->with($idProductAbstract)
            ->willReturn($this->spyGiftCardProductAbstractConfigurationLinkQueryMock);

        $this->spyGiftCardProductAbstractConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('findOne')
            ->willReturn($this->spyGiftCardProductAbstractConfigurationLinkMock);

        $this->spyGiftCardProductAbstractConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('filterByIdGiftCardProductAbstractConfigurationLink')
            ->willReturn($this->spyGiftCardProductAbstractConfigurationLinkQueryMock);

        $this->spyGiftCardProductAbstractConfigurationLinkMock->expects(static::atLeastOnce())
            ->method('getIdGiftCardProductAbstractConfigurationLink')
            ->willReturn(1);

        $this->spyGiftCardProductAbstractConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('delete')
            ->willReturn(1);

        $this->spyGiftCardProductAbstractConfigurationEntityTransferMock->expects(static::atLeastOnce())
            ->method('getIdGiftCardProductAbstractConfiguration')
            ->willReturn(1);

        $this->productAbstractMock->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn(1);

        $this->spyGiftCardProductAbstractConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('filterByFkGiftCardProductAbstractConfiguration')
            ->with(1)
            ->willReturn($this->spyGiftCardProductAbstractConfigurationLinkQueryMock);

        $this->spyGiftCardProductAbstractConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('filterByFkProductAbstract')
            ->with(1)
            ->willReturn($this->spyGiftCardProductAbstractConfigurationLinkQueryMock);

        $this->spyGiftCardProductAbstractConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('findOneOrCreate')
            ->willReturn($this->spyGiftCardProductAbstractConfigurationLinkMock);

        $this->spyGiftCardProductAbstractConfigurationLinkMock->expects(static::atLeastOnce())
            ->method('save')
            ->willReturn(1);

        $this->giftCardProductProductConnectorPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('createGiftCardProductAbstractConfigurationLinkMapper')
            ->willReturn($this->giftCardProductAbstractConfigurationLinkMapperMock);

        $this->giftCardProductAbstractConfigurationLinkMapperMock->expects(static::atLeastOnce())
            ->method('mapEntityToTransfer')
            ->willReturn($this->spyGiftCardProductAbstractConfigurationLinkEntityTransferMock);

        $entityTransfer = $this->giftCardProductConnectorEntityManager->saveGiftCardProductAbstractConfiguration(
            $this->productAbstractTransferMock,
            $pattern
        );

        $this->assertInstanceOf(SpyGiftCardProductAbstractConfigurationEntityTransfer::class, $entityTransfer);
        $this->assertEquals(
            $this->spyGiftCardProductAbstractConfigurationEntityTransferMock,
            $entityTransfer
        );

        $this->assertEquals($entityTransfer->getIdGiftCardProductAbstractConfiguration(), 1);
    }

    /**
     * @return void
     */
    public function testSaveGiftCardProductConfiguration(): void
    {
        $value = 10;
        $sku = 'sku';
        $idProduct = 1;

        $this->giftCardProductProductConnectorPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('createSpyGiftCardProductConfigurationQuery')
            ->willReturn($this->spyGiftCardProductConfigurationQueryMock);

        $this->spyGiftCardProductConfigurationQueryMock->expects(static::atLeastOnce())
            ->method('filterByValue')
            ->with($value)
            ->willReturn($this->spyGiftCardProductConfigurationQueryMock);

        $this->spyGiftCardProductConfigurationQueryMock->expects(static::atLeastOnce())
            ->method('findOneOrCreate')
            ->willReturn($this->spyGiftCardProductConfigurationMock);

        $this->spyGiftCardProductConfigurationMock->expects(static::atLeastOnce())
            ->method('save')
            ->willReturn(1);

        $this->giftCardProductProductConnectorPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('createGiftCardProductConfigurationMapper')
            ->willReturn($this->giftCardProductConfigurationMapperMock);

        $this->giftCardProductConfigurationMapperMock->expects(static::atLeastOnce())
            ->method('mapEntityToTransfer')
            ->with($this->spyGiftCardProductConfigurationMock)
            ->willReturn($this->spyGiftCardProductConfigurationEntityTransferMock);

        $this->spyGiftCardProductConfigurationEntityTransferMock->expects(static::atLeastOnce())
            ->method('addSpyGiftCardProductConfigurationLinks')
            ->willReturn($this->spyGiftCardProductConfigurationEntityTransferMock);

        $this->productConcreteTransferMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($sku);

        $this->giftCardProductProductConnectorPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('createProductQuery')
            ->willReturn($this->productQueryMock);

        $this->productQueryMock->expects(static::atLeastOnce())
            ->method('findOneBySku')
            ->willReturn($this->productMock);

        $this->giftCardProductProductConnectorPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('createSpyGiftCardProductConfigurationLinkQuery')
            ->willReturn($this->spyGiftCardProductConfigurationLinkQueryMock);

        $this->spyGiftCardProductConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('filterByFkProduct')
            ->with($idProduct)
            ->willReturn($this->spyGiftCardProductConfigurationLinkQueryMock);

        $this->spyGiftCardProductConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('findOne')
            ->willReturn(null);

        $this->spyGiftCardProductConfigurationEntityTransferMock->expects(static::atLeastOnce())
            ->method('getIdGiftCardProductConfiguration')
            ->willReturn(1);

        $this->productMock->expects(static::atLeastOnce())
            ->method('getIdProduct')
            ->willReturn(1);

        $this->spyGiftCardProductConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('filterByFkGiftCardProductConfiguration')
            ->with(1)
            ->willReturn($this->spyGiftCardProductConfigurationLinkQueryMock);

        $this->spyGiftCardProductConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('filterByFkProduct')
            ->with(1)
            ->willReturn($this->spyGiftCardProductConfigurationLinkQueryMock);

        $this->spyGiftCardProductConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('findOneOrCreate')
            ->willReturn($this->spyGiftCardProductConfigurationLinkMock);

        $this->spyGiftCardProductConfigurationLinkMock->expects(static::atLeastOnce())
            ->method('save')
            ->willReturn(1);

        $this->giftCardProductProductConnectorPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('createGiftCardProductConfigurationLinkMapper')
            ->willReturn($this->giftCardProductConfigurationLinkMapperMock);

        $this->giftCardProductConfigurationLinkMapperMock->expects(static::atLeastOnce())
            ->method('mapEntityToTransfer')
            ->willReturn($this->spyGiftCardProductConfigurationLinkEntityTransferMock);

        $entityTransfer = $this->giftCardProductConnectorEntityManager->saveGiftCardProductConfiguration(
            $this->productConcreteTransferMock,
            $value
        );

        $this->assertInstanceOf(SpyGiftCardProductConfigurationEntityTransfer::class, $entityTransfer);
        $this->assertEquals(
            $this->spyGiftCardProductConfigurationEntityTransferMock,
            $entityTransfer
        );

        $this->assertEquals($entityTransfer->getIdGiftCardProductConfiguration(), 1);
    }

    /**
     * @return void
     */
    public function testSaveGiftCardProductConfigurationAndDeleteConfigurationLinks(): void
    {
        $value = 10;
        $sku = 'sku';
        $idProduct = 1;

        $this->giftCardProductProductConnectorPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('createSpyGiftCardProductConfigurationQuery')
            ->willReturn($this->spyGiftCardProductConfigurationQueryMock);

        $this->spyGiftCardProductConfigurationQueryMock->expects(static::atLeastOnce())
            ->method('filterByValue')
            ->with($value)
            ->willReturn($this->spyGiftCardProductConfigurationQueryMock);

        $this->spyGiftCardProductConfigurationQueryMock->expects(static::atLeastOnce())
            ->method('findOneOrCreate')
            ->willReturn($this->spyGiftCardProductConfigurationMock);

        $this->spyGiftCardProductConfigurationMock->expects(static::atLeastOnce())
            ->method('save')
            ->willReturn(1);

        $this->giftCardProductProductConnectorPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('createGiftCardProductConfigurationMapper')
            ->willReturn($this->giftCardProductConfigurationMapperMock);

        $this->giftCardProductConfigurationMapperMock->expects(static::atLeastOnce())
            ->method('mapEntityToTransfer')
            ->with($this->spyGiftCardProductConfigurationMock)
            ->willReturn($this->spyGiftCardProductConfigurationEntityTransferMock);

        $this->spyGiftCardProductConfigurationEntityTransferMock->expects(static::atLeastOnce())
            ->method('addSpyGiftCardProductConfigurationLinks')
            ->willReturn($this->spyGiftCardProductConfigurationEntityTransferMock);

        $this->productConcreteTransferMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($sku);

        $this->giftCardProductProductConnectorPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('createProductQuery')
            ->willReturn($this->productQueryMock);

        $this->productQueryMock->expects(static::atLeastOnce())
            ->method('findOneBySku')
            ->willReturn($this->productMock);

        $this->giftCardProductProductConnectorPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('createSpyGiftCardProductConfigurationLinkQuery')
            ->willReturn($this->spyGiftCardProductConfigurationLinkQueryMock);

        $this->spyGiftCardProductConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('filterByFkProduct')
            ->with($idProduct)
            ->willReturn($this->spyGiftCardProductConfigurationLinkQueryMock);

        $this->spyGiftCardProductConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('findOne')
            ->willReturn($this->spyGiftCardProductConfigurationLinkMock);

        $this->spyGiftCardProductConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('filterByIdGiftCardProductConfigurationLink')
            ->willReturn($this->spyGiftCardProductConfigurationLinkQueryMock);

        $this->spyGiftCardProductConfigurationLinkMock->expects(static::atLeastOnce())
            ->method('getIdGiftCardProductConfigurationLink')
            ->willReturn(1);

        $this->spyGiftCardProductConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('delete')
            ->willReturn(1);

        $this->spyGiftCardProductConfigurationEntityTransferMock->expects(static::atLeastOnce())
            ->method('getIdGiftCardProductConfiguration')
            ->willReturn(1);

        $this->productMock->expects(static::atLeastOnce())
            ->method('getIdProduct')
            ->willReturn(1);

        $this->spyGiftCardProductConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('filterByFkGiftCardProductConfiguration')
            ->with(1)
            ->willReturn($this->spyGiftCardProductConfigurationLinkQueryMock);

        $this->spyGiftCardProductConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('filterByFkProduct')
            ->with(1)
            ->willReturn($this->spyGiftCardProductConfigurationLinkQueryMock);

        $this->spyGiftCardProductConfigurationLinkQueryMock->expects(static::atLeastOnce())
            ->method('findOneOrCreate')
            ->willReturn($this->spyGiftCardProductConfigurationLinkMock);

        $this->spyGiftCardProductConfigurationLinkMock->expects(static::atLeastOnce())
            ->method('save')
            ->willReturn(1);

        $this->giftCardProductProductConnectorPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('createGiftCardProductConfigurationLinkMapper')
            ->willReturn($this->giftCardProductConfigurationLinkMapperMock);

        $this->giftCardProductConfigurationLinkMapperMock->expects(static::atLeastOnce())
            ->method('mapEntityToTransfer')
            ->willReturn($this->spyGiftCardProductConfigurationLinkEntityTransferMock);

        $entityTransfer = $this->giftCardProductConnectorEntityManager->saveGiftCardProductConfiguration(
            $this->productConcreteTransferMock,
            $value
        );

        $this->assertInstanceOf(SpyGiftCardProductConfigurationEntityTransfer::class, $entityTransfer);
        $this->assertEquals(
            $this->spyGiftCardProductConfigurationEntityTransferMock,
            $entityTransfer
        );

        $this->assertEquals($entityTransfer->getIdGiftCardProductConfiguration(), 1);
    }
}
