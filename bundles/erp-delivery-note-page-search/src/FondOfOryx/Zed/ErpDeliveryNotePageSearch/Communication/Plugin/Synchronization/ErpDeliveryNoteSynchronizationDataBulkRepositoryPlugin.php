<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\Plugin\Synchronization;

use FondOfOryx\Shared\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConstants;
use Generated\Shared\Transfer\FilterTransfer;
use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Orm\Zed\ErpDeliveryNotePageSearch\Persistence\Map\FooErpDeliveryNotePageSearchTableMap;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SynchronizationExtension\Dependency\Plugin\SynchronizationDataBulkRepositoryPluginInterface;

/**
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig getConfig()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\ErpDeliveryNotePageSearchFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\ErpDeliveryNotePageSearchCommunicationFactory getFactory()
 */
class ErpDeliveryNoteSynchronizationDataBulkRepositoryPlugin extends AbstractPlugin implements SynchronizationDataBulkRepositoryPluginInterface
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

        $erpDeliveryNotePageSearchEntityTransfers = $this->getRepository()
            ->findFilteredErpDeliveryNotePageSearchEntities($filterTransfer, $ids);

        foreach ($erpDeliveryNotePageSearchEntityTransfers as $erpDeliveryNotePageSearchEntityTransfer) {
            $synchronizationDataTransfer = (new SynchronizationDataTransfer())
                ->setData($erpDeliveryNotePageSearchEntityTransfer->getData())
                ->setKey($erpDeliveryNotePageSearchEntityTransfer->getKey());

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
            ->setOrderBy(FooErpDeliveryNotePageSearchTableMap::COL_FK_ERP_DELIVERY_NOTE);
    }

    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return ErpDeliveryNotePageSearchConstants::ERP_DELIVERY_NOTE_RESOURCE_NAME;
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
        return ['type' => 'erp-delivery-note'];
    }

    /**
     * @return string
     */
    public function getQueueName(): string
    {
        return ErpDeliveryNotePageSearchConstants::ERP_DELIVERY_NOTE_SYNC_SEARCH_QUEUE;
    }

    /**
     * @return string|null
     */
    public function getSynchronizationQueuePoolName(): ?string
    {
        return $this->getConfig()->getErpDeliveryNotePageSynchronizationPoolName();
    }
}
