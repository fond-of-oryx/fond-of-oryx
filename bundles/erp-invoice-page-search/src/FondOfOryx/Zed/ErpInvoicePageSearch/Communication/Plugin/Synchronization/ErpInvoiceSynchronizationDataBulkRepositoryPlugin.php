<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Communication\Plugin\Synchronization;

use FondOfOryx\Shared\ErpInvoicePageSearch\ErpInvoicePageSearchConstants;
use Generated\Shared\Transfer\FilterTransfer;
use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Orm\Zed\ErpInvoicePageSearch\Persistence\Map\FooErpInvoicePageSearchTableMap;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SynchronizationExtension\Dependency\Plugin\SynchronizationDataBulkRepositoryPluginInterface;

/**
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig getConfig()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Business\ErpInvoicePageSearchFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Communication\ErpInvoicePageSearchCommunicationFactory getFactory()
 */
class ErpInvoiceSynchronizationDataBulkRepositoryPlugin extends AbstractPlugin implements SynchronizationDataBulkRepositoryPluginInterface
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

        $erpInvoicePageSearchEntityTransfers = $this->getRepository()
            ->findFilteredErpInvoicePageSearchEntities($filterTransfer, $ids);

        foreach ($erpInvoicePageSearchEntityTransfers as $erpInvoicePageSearchEntityTransfer) {
            $synchronizationDataTransfer = (new SynchronizationDataTransfer())
                ->setData($erpInvoicePageSearchEntityTransfer->getData())
                ->setKey($erpInvoicePageSearchEntityTransfer->getKey());

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
            ->setOrderBy(FooErpInvoicePageSearchTableMap::COL_FK_ERP_INVOICE);
    }

    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return ErpInvoicePageSearchConstants::ERP_INVOICE_RESOURCE_NAME;
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
        return ['type' => 'erp-invoice'];
    }

    /**
     * @return string
     */
    public function getQueueName(): string
    {
        return ErpInvoicePageSearchConstants::ERP_INVOICE_SYNC_SEARCH_QUEUE;
    }

    /**
     * @return string|null
     */
    public function getSynchronizationQueuePoolName(): ?string
    {
        return $this->getConfig()->getErpInvoicePageSynchronizationPoolName();
    }
}
