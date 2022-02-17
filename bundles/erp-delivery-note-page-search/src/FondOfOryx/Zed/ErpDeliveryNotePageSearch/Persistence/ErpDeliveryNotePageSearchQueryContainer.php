<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence;

use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchPersistenceFactory getFactory()
 */
class ErpDeliveryNotePageSearchQueryContainer extends AbstractQueryContainer implements ErpDeliveryNotePageSearchQueryContainerInterface
{
    /**
     * @param array<int> $erpDeliveryNoteIds
     *
     * @return \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery
     */
    public function queryErpDeliveryNotesByErpDeliveryNoteIds(
        array $erpDeliveryNoteIds
    ): FooErpDeliveryNoteQuery {
        $erpDeliveryNoteQuery = $this->getFactory()->getErpDeliveryNoteQuery()->clear();

        if (count($erpDeliveryNoteIds) === 0) {
            return $erpDeliveryNoteQuery;
        }

        return $erpDeliveryNoteQuery->filterByIdErpDeliveryNote_In(
            $erpDeliveryNoteIds,
        );
    }

    /**
     * @param array<int> $erpDeliveryNoteIds
     *
     * @return \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery
     */
    public function queryErpDeliveryNoteWithAddressesAndCompanyBusinessUnitByErpDeliveryNoteIds(
        array $erpDeliveryNoteIds
    ): FooErpDeliveryNoteQuery {
        return $this->queryErpDeliveryNotesByErpDeliveryNoteIds($erpDeliveryNoteIds);
    }
}
