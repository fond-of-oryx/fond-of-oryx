<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Persistence;

use Orm\Zed\ErpOrder\Persistence\ErpOrderQuery;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchPersistenceFactory getFactory()
 */
class ErpOrderPageSearchQueryContainer extends AbstractQueryContainer implements ErpOrderPageSearchQueryContainerInterface
{
    /**
     * @param array<int> $erpOrderIds
     *
     * @return \Orm\Zed\ErpOrder\Persistence\ErpOrderQuery
     */
    public function queryErpOrdersByErpOrderIds(
        array $erpOrderIds
    ): ErpOrderQuery {
        $erpOrderQuery = $this->getFactory()->getErpOrderQuery()->clear();

        if (count($erpOrderIds) === 0) {
            return $erpOrderQuery;
        }

        return $erpOrderQuery->filterByIdErpOrder_In(
            $erpOrderIds,
        );
    }

    /**
     * @param array<int> $erpOrderIds
     *
     * @return \Orm\Zed\ErpOrder\Persistence\ErpOrderQuery
     */
    public function queryErpOrderWithAddressesAndCompanyBusinessUnitByErpOrderIds(
        array $erpOrderIds
    ): ErpOrderQuery {
        $fooErpOrderQuery = $this->queryErpOrdersByErpOrderIds($erpOrderIds);

        return $fooErpOrderQuery;
    }
}
