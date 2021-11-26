<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Persistence;

use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchPersistenceFactory getFactory()
 */
class ErpInvoicePageSearchQueryContainer extends AbstractQueryContainer implements ErpInvoicePageSearchQueryContainerInterface
{
    /**
     * @param array<int> $erpInvoiceIds
     *
     * @return \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery
     */
    public function queryErpInvoicesByErpInvoiceIds(
        array $erpInvoiceIds
    ): FooErpInvoiceQuery {
        $erpInvoiceQuery = $this->getFactory()->getErpInvoiceQuery()->clear();

        if (empty($erpInvoiceIds)) {
            return $erpInvoiceQuery;
        }

        return $erpInvoiceQuery->filterByIdErpInvoice_In(
            $erpInvoiceIds,
        );
    }

    /**
     * @param array<int> $erpInvoiceIds
     *
     * @return \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery
     */
    public function queryErpInvoiceWithAddressesAndCompanyBusinessUnitByErpInvoiceIds(
        array $erpInvoiceIds
    ): FooErpInvoiceQuery {
        return $this->queryErpInvoicesByErpInvoiceIds($erpInvoiceIds);
    }
}
