<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Communication\Plugin\Synchronization;

use FondOfOryx\Shared\ErpOrderPageSearch\ErpOrderPageSearchConstants;
use Generated\Shared\Transfer\FilterTransfer;
use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Orm\Zed\ErpOrderPageSearch\Persistence\Map\FooErpOrderPageSearchTableMap;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SynchronizationExtension\Dependency\Plugin\SynchronizationDataBulkRepositoryPluginInterface;

/**
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig getConfig()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Business\ErpOrderPageSearchFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Communication\ErpOrderPageSearchCommunicationFactory getFactory()
 */
class ErpOrderSynchronizationDataBulkRepositoryPlugin extends AbstractPlugin implements SynchronizationDataBulkRepositoryPluginInterface
{
    /**
     * @param int $offset
     * @param int $limit
     * @param array $ids
     *
     * @return array
     */
    public function getData(int $offset, int $limit, array $ids = []): array
    {
        $data = [];
        $filterTransfer = $this->createFilterTransfer($offset, $limit);

        $erpOrderPageSearchEntityTransfers = $this->getRepository()
            ->findFilteredErpOrderPageSearchEntities($filterTransfer, $ids);

        foreach ($erpOrderPageSearchEntityTransfers as $erpOrderPageSearchEntityTransfer) {
            $synchronizationDataTransfer = (new SynchronizationDataTransfer())
                ->setData($erpOrderPageSearchEntityTransfer->getData())
                ->setKey($erpOrderPageSearchEntityTransfer->getKey());

            $data[] = $synchronizationDataTransfer;
        }

        return $data;
    }

    /**
     * {@inheritDoc}
     *
     * @param int $offset
     * @param int $limit
     *
     * @return \Generated\Shared\Transfer\FilterTransfer
     */
    protected function createFilterTransfer(int $offset, int $limit): FilterTransfer
    {
        return (new FilterTransfer())
            ->setOffset($offset)
            ->setLimit($limit)
            ->setOrderBy(FooErpOrderPageSearchTableMap::COL_FK_ERP_ORDER);
    }

    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return ErpOrderPageSearchConstants::ERP_ORDER_RESOURCE_NAME;
    }

    /**
     * @return bool
     */
    public function hasStore(): bool
    {
        return false;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return ['type' => 'erp-order'];
    }

    /**
     * @return string
     */
    public function getQueueName(): string
    {
        return ErpOrderPageSearchConstants::ERP_ORDER_SYNC_SEARCH_QUEUE;
    }

    /**
     * @return string|null
     */
    public function getSynchronizationQueuePoolName(): ?string
    {
        return $this->getConfig()->getErpOrderPageSynchronizationPoolName();
    }
}
