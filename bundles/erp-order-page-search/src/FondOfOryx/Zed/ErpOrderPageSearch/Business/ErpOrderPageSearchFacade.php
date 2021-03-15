<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Business\ErpOrderPageSearchBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchRepositoryInterface getRepository()
 */
class ErpOrderPageSearchFacade extends AbstractFacade implements ErpOrderPageSearchFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $erpOrderIds
     *
     * @return void
     */
    public function publish(array $erpOrderIds): void
    {
        $this->getFactory()->createErpOrderPageSearchPublisher()
            ->publish($erpOrderIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $erpOrderIds
     *
     * @return void
     */
    public function unpublish(array $erpOrderIds): void
    {
        $this->getFactory()->createErpOrderPageSearchUnPublisher()
            ->unpublish($erpOrderIds);
    }
}
