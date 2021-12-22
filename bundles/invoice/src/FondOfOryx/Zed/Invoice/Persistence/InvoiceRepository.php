<?php

namespace FondOfOryx\Zed\Invoice\Persistence;

use Generated\Shared\Transfer\ItemTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\Invoice\Persistence\InvoicePersistenceFactory getFactory()
 */
class InvoiceRepository extends AbstractRepository implements InvoiceRepositoryInterface
{
    /**
     * @param int $idSalesOrderItem
     *
     * @return \Generated\Shared\Transfer\ItemTransfer|null
     */
    public function findInvoiceItemByIdSalesOrderItem(int $idSalesOrderItem): ?ItemTransfer
    {
        $fooInvoiceItemQuery = $this->getFactory()->createInvoiceItemQuery();

        $fooInvoiceItem = $fooInvoiceItemQuery->filterByFkSalesOrderItem($idSalesOrderItem)
            ->findOne();

        if ($fooInvoiceItem === null) {
            return null;
        }

        return $this->getFactory()->createInvoiceItemMapper()->mapEntityToTransfer(
            $fooInvoiceItem,
            new ItemTransfer(),
        );
    }
}
