<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Persistence;

use Generated\Shared\Transfer\ErpInvoicePageSearchTransfer;
use Orm\Zed\ErpInvoicePageSearch\Persistence\FooErpInvoicePageSearch;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * Class ErpInvoicePageSearchEntityManager
 *
 * @package FondOfOryx\Zed\ErpInvoicePageSearch\Persistence
 *
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchPersistenceFactory getFactory()
 */
class ErpInvoicePageSearchEntityManager extends AbstractEntityManager implements ErpInvoicePageSearchEntityManagerInterface
{
    /**
     * @param array $erpInvoiceIds
     *
     * @return void
     */
    public function deleteErpInvoiceSearchPagesByErpInvoiceIds(array $erpInvoiceIds): void
    {
        $entities = $this->getFactory()->getErpInvoicePageSearchQuery()->filterByFkErpInvoice_In($erpInvoiceIds)->find();

        foreach ($entities as $entity) {
            $entity->delete();
        }
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoicePageSearchTransfer $erpInvoicePageSearchTransfer
     *
     * @return void
     */
    public function createErpInvoicePageSearch(ErpInvoicePageSearchTransfer $erpInvoicePageSearchTransfer): void
    {
        $fooErpInvoicePageSearch = $this->getFactory()->createErpInvoicePageSearchMapper()->mapTransferToEntity(
            $erpInvoicePageSearchTransfer,
            new FooErpInvoicePageSearch(),
        );

        $fooErpInvoicePageSearch->save();
    }
}
