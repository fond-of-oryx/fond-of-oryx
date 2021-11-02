<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\Plugin\Synchronization;

use FondOfOryx\Shared\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageConfig;
use Generated\Shared\Transfer\FilterTransfer;
use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Orm\Zed\ProductLocaleRestrictionStorage\Persistence\Map\FooProductAbstractLocaleRestrictionStorageTableMap;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SynchronizationExtension\Dependency\Plugin\SynchronizationDataBulkRepositoryPluginInterface;

/**
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageConfig getConfig()
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business\ProductLocaleRestrictionStorageFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\ProductLocaleRestrictionStorageCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Persistence\ProductLocaleRestrictionStorageRepositoryInterface getRepository()
 */
class ProductAbstractLocaleRestrictionStorageSynchronizationDataBulkPlugin extends AbstractPlugin implements SynchronizationDataBulkRepositoryPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $offset
     * @param int $limit
     * @param array<int> $ids
     *
     * @return array<\Generated\Shared\Transfer\SynchronizationDataTransfer>
     */
    public function getData(int $offset, int $limit, array $ids = []): array
    {
        $synchronizationDataTransfers = [];
        $filterTransfer = $this->createFilterTransfer($offset, $limit);

        $productAbstractLocaleRestrictionStorageEntityTransfers = $this->getRepository()
            ->findFilteredProductAbstractLocaleRestrictionStorageEntities($filterTransfer, $ids);

        foreach ($productAbstractLocaleRestrictionStorageEntityTransfers as $productAbstractLocaleRestrictionStorageEntityTransfer) {
            $synchronizationDataTransfers[] = (new SynchronizationDataTransfer())
                ->setData($productAbstractLocaleRestrictionStorageEntityTransfer->getData())
                ->setKey($productAbstractLocaleRestrictionStorageEntityTransfer->getKey());
        }

        return $synchronizationDataTransfers;
    }

    /**
     * @param int $offset
     * @param int $limit
     *
     * @return \Generated\Shared\Transfer\FilterTransfer
     */
    protected function createFilterTransfer(int $offset, int $limit): FilterTransfer
    {
        return (new FilterTransfer())
            ->setOrderBy(
                FooProductAbstractLocaleRestrictionStorageTableMap::COL_ID_PRODUCT_ABSTRACT_LOCALE_RESTRICTION_STORAGE,
            )
            ->setOffset($offset)
            ->setLimit($limit);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getResourceName(): string
    {
        return ProductLocaleRestrictionStorageConfig::PRODUCT_ABSTRACT_LOCALE_RESTRICTION_RESOURCE_NAME;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return bool
     */
    public function hasStore(): bool
    {
        return false;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return array
     */
    public function getParams(): array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getQueueName(): string
    {
        return ProductLocaleRestrictionStorageConfig::PRODUCT_ABSTRACT_LOCALE_RESTRICTION_SYNC_STORAGE_QUEUE;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string|null
     */
    public function getSynchronizationQueuePoolName(): ?string
    {
        return $this->getConfig()->getProductAbstractLocaleRestrictionSynchronizationPoolName();
    }
}
