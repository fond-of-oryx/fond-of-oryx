<?php

namespace FondOfOryx\Zed\GiftCardProductConnector;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorEntityManager;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorPersistenceFactory;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductAbstractConfigurationMapperInterface;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfiguration;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationLink;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationLinkQuery;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationQuery;
use Orm\Zed\Product\Persistence\SpyProductAbstract;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;

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
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorPersistenceFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $giftCardProductAbstractConfigurationMapperMock;

    /**
     * @var \Generated\Shared\Transfer\ProductAbstractTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractTransferMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductAbstractConfigurationMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyGiftCardProductAbstractConfigurationQueryMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper\GiftCardProductAbstractConfigurationLinkMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyGiftCardProductAbstractConfigurationLinkQueryMock;

    /**
     * @var \Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationLink|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyGiftCardProductAbstractConfigurationLinkMock;

    /**
     * @var \Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyGiftCardProductAbstractConfigurationEntityTransferMock;

    /**
     * @var \Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfiguration|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyGiftCardProductAbstractConfigurationMock;

    /**
     * @var \Orm\Zed\Product\Persistence\SpyProductAbstractQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractQueryMock;

    /**
     * @var \Orm\Zed\Product\Persistence\SpyProductAbstract|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->giftCardProductProductConnectorPersistenceFactoryMock = $this->getMockBuilder(GiftCardProductConnectorPersistenceFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductAbstractConfigurationQueryMock = $this->getMockBuilder(SpyGiftCardProductAbstractConfigurationQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardProductAbstractConfigurationMapperMock = $this
            ->getMockBuilder(GiftCardProductAbstractConfigurationMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductAbstractConfigurationEntityTransferMock = $this
            ->getMockBuilder(SpyGiftCardProductAbstractConfigurationEntityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyGiftCardProductAbstractConfigurationMock = $this
            ->getMockBuilder(SpyGiftCardProductAbstractConfiguration::class)
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

        $this->productAbstractQueryMock = $this->getMockBuilder(SpyProductAbstractQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractMock = $this->getMockBuilder(SpyProductAbstract::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this
            ->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardProductConnectorEntityManager = new GiftCardProductConnectorEntityManager();
        $this->giftCardProductConnectorEntityManager->setFactory($this->giftCardProductProductConnectorPersistenceFactoryMock);
    }

    /**
     * @skip
     *
     * @return void
     */
    public function testCreateGiftCardProductAbstractConfiguration(): void
    {
        $pattern = '{randomPart}';
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

        $entityTransfer = $this->giftCardProductConnectorEntityManager->createGiftCardProductAbstractConfiguration(
            $this->productAbstractTransferMock,
            $pattern
        );

        $this->assertEquals(
            $this->spyGiftCardProductAbstractConfigurationEntityTransferMock,
            $entityTransfer
        );
    }
}
