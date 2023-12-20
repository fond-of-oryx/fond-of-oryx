<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Persistence;

use Generated\Shared\Transfer\ErpInvoicePageSearchTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @codeCoverageIgnore
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
    public function persistErpInvoicePageSearch(ErpInvoicePageSearchTransfer $erpInvoicePageSearchTransfer): void
    {
        $fooErpInvoicePageSearch = $this->getFactory()->getErpInvoicePageSearchQuery()
            ->filterByFkErpInvoice($erpInvoicePageSearchTransfer->getFkErpInvoice())
            ->findOneOrCreate();

        $fooErpInvoicePageSearch = $this->getFactory()->createErpInvoicePageSearchMapper()
            ->mapTransferToEntity($erpInvoicePageSearchTransfer, $fooErpInvoicePageSearch);

        $fooErpInvoicePageSearch->save();
    }
}
