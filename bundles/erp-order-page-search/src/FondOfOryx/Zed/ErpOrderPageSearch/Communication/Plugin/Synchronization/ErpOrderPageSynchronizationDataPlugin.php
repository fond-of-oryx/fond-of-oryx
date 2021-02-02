<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Communication\Plugin\Synchronization;

use FondOfOryx\Shared\ErpOrderPageSearch\ErpOrderPageSearchConstants;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SynchronizationExtension\Dependency\Plugin\SynchronizationDataQueryContainerPluginInterface;

/**
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig getConfig()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Business\ErpOrderPageSearchFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Communication\ErpOrderPageSearchCommunicationFactory getFactory()
 */
class ErpOrderPageSynchronizationDataPlugin extends AbstractPlugin implements SynchronizationDataQueryContainerPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getResourceName(): string
    {
        return ErpOrderPageSearchConstants::ERP_ORDER_RESOURCE_NAME;
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
     * @param int[] $ids
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria|null
     */
    public function queryData($ids = []): ?ModelCriteria
    {

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
        return ['type' => 'erp-order'];
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
        return ErpOrderPageSearchConstants::ERP_ORDER_SYNC_SEARCH_QUEUE;
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
        return $this->getFactory()->getConfig()->getErpOrderPageSynchronizationPoolName();
    }
}
