<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Business\ErpInvoicePageSearchBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchRepositoryInterface getRepository()
 */
class ErpInvoicePageSearchFacade extends AbstractFacade implements ErpInvoicePageSearchFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $erpInvoiceIds
     *
     * @return void
     */
    public function publish(array $erpInvoiceIds): void
    {
        $this->getFactory()
            ->createErpInvoicePageSearchPublisher()
            ->publish($erpInvoiceIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $erpInvoiceIds
     *
     * @return void
     */
    public function unpublish(array $erpInvoiceIds): void
    {
        $this->getFactory()->createErpInvoicePageSearchUnPublisher()
            ->unpublish($erpInvoiceIds);
    }
}
