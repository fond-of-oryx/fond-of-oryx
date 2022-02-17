<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence;

use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery;

interface ErpDeliveryNotePageSearchQueryContainerInterface
{
    /**
     * @param array<int> $erpDeliveryNoteIds
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @return \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery
     */
    public function queryErpDeliveryNotesByErpDeliveryNoteIds(
        array $erpDeliveryNoteIds
    ): FooErpDeliveryNoteQuery;

    /**
     * @param array<int> $erpDeliveryNoteIds
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @return \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery
     */
    public function queryErpDeliveryNoteWithAddressesAndCompanyBusinessUnitByErpDeliveryNoteIds(
        array $erpDeliveryNoteIds
    ): FooErpDeliveryNoteQuery;
}
