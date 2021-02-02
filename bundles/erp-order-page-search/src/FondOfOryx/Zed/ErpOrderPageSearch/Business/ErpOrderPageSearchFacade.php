<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

class ErpOrderPageSearchFacade extends AbstractFacade
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
