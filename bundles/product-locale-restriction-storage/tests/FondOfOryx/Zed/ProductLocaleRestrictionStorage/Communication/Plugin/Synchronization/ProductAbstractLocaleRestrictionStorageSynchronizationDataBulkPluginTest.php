<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\Plugin\Synchronization;

use Codeception\Test\Unit;
use FondOfOryx\Shared\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageConfig as SharedProductLocaleRestrictionStorageConfig;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Persistence\ProductLocaleRestrictionStorageRepository;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageConfig;
use Generated\Shared\Transfer\FilterTransfer;
use Generated\Shared\Transfer\FooProductAbstractLocaleRestrictionStorageEntityTransfer;
use Orm\Zed\ProductLocaleRestrictionStorage\Persistence\Map\FooProductAbstractLocaleRestrictionStorageTableMap;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ProductAbstractLocaleRestrictionStorageSynchronizationDataBulkPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Persistence\ProductLocaleRestrictionStorageRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject>|array<\Generated\Shared\Transfer\FooProductAbstractLocaleRestrictionStorageEntityTransfer>
     */
    protected $fooProductAbstractLocaleRestrictionStorageEntityTransferMocks;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\Plugin\Synchronization\ProductAbstractLocaleRestrictionStorageSynchronizationDataBulkPlugin
     */
    protected $productAbstractLocaleRestrictionStorageSynchronizationDataBulkPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ProductLocaleRestrictionStorageRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(ProductLocaleRestrictionStorageConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->fooProductAbstractLocaleRestrictionStorageEntityTransferMocks = [
            $this->getMockBuilder(FooProductAbstractLocaleRestrictionStorageEntityTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        if (method_exists(ProductAbstractLocaleRestrictionStorageSynchronizationDataBulkPlugin::class, 'setConfig')) {
            $this->productAbstractLocaleRestrictionStorageSynchronizationDataBulkPlugin = new ProductAbstractLocaleRestrictionStorageSynchronizationDataBulkPlugin();
            $this->productAbstractLocaleRestrictionStorageSynchronizationDataBulkPlugin->setConfig($this->configMock);
        } else {
            $this->productAbstractLocaleRestrictionStorageSynchronizationDataBulkPlugin = new class ($this->configMock) extends ProductAbstractLocaleRestrictionStorageSynchronizationDataBulkPlugin {
                /**
                 * @var \Spryker\Zed\Kernel\AbstractBundleConfig
                 */
                protected $productLocaleRestrictionStorageConfig;

                /**
                 * @param \Spryker\Zed\Kernel\AbstractBundleConfig $config
                 */
                public function __construct(AbstractBundleConfig $config)
                {
                    $this->productLocaleRestrictionStorageConfig = $config;
                }

                /**
                 * @return \Spryker\Zed\Kernel\AbstractBundleConfig
                 */
                protected function getConfig(): AbstractBundleConfig
                {
                    return $this->productLocaleRestrictionStorageConfig;
                }
            };
        }

        $this->productAbstractLocaleRestrictionStorageSynchronizationDataBulkPlugin->setRepository(
            $this->repositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testGetData(): void
    {
        $offset = 1;
        $limit = 12;
        $ids = [1, 2, 3, 4, 5];

        $key = 'key';
        $data = '{}';

        $this->fooProductAbstractLocaleRestrictionStorageEntityTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($data);

        $this->fooProductAbstractLocaleRestrictionStorageEntityTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getKey')
            ->willReturn($key);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findFilteredProductAbstractLocaleRestrictionStorageEntities')
            ->with(
                static::callback(
                    static function (FilterTransfer $filterTransfer) use ($offset, $limit) {
                        return $filterTransfer->getOrderBy() === FooProductAbstractLocaleRestrictionStorageTableMap::COL_ID_PRODUCT_ABSTRACT_LOCALE_RESTRICTION_STORAGE
                            && $filterTransfer->getOffset() === $offset
                            && $filterTransfer->getLimit() === $limit;
                    },
                ),
                $ids,
            )->willReturn(
                $this->fooProductAbstractLocaleRestrictionStorageEntityTransferMocks,
            );

        $synchronizationDataTransfers = $this->productAbstractLocaleRestrictionStorageSynchronizationDataBulkPlugin
            ->getData($offset, $limit, $ids);

        static::assertCount(1, $synchronizationDataTransfers);
        static::assertEquals($data, $synchronizationDataTransfers[0]->getData());
        static::assertEquals($key, $synchronizationDataTransfers[0]->getKey());
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        static::assertEquals(
            SharedProductLocaleRestrictionStorageConfig::PRODUCT_ABSTRACT_LOCALE_RESTRICTION_RESOURCE_NAME,
            $this->productAbstractLocaleRestrictionStorageSynchronizationDataBulkPlugin->getResourceName(),
        );
    }

    /**
     * @return void
     */
    public function testHasStore(): void
    {
        static::assertFalse(
            $this->productAbstractLocaleRestrictionStorageSynchronizationDataBulkPlugin->hasStore(),
        );
    }

    /**
     * @return void
     */
    public function testGetParams(): void
    {
        static::assertCount(
            0,
            $this->productAbstractLocaleRestrictionStorageSynchronizationDataBulkPlugin->getParams(),
        );
    }

    /**
     * @return void
     */
    public function testGetQueueName(): void
    {
        static::assertEquals(
            SharedProductLocaleRestrictionStorageConfig::PRODUCT_ABSTRACT_LOCALE_RESTRICTION_SYNC_STORAGE_QUEUE,
            $this->productAbstractLocaleRestrictionStorageSynchronizationDataBulkPlugin->getQueueName(),
        );
    }

    /**
     * @return void
     */
    public function testGetSynchronizationQueuePoolName(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getProductAbstractLocaleRestrictionSynchronizationPoolName')
            ->willReturn(null);

        static::assertEquals(
            null,
            $this->productAbstractLocaleRestrictionStorageSynchronizationDataBulkPlugin->getSynchronizationQueuePoolName(),
        );
    }
}
