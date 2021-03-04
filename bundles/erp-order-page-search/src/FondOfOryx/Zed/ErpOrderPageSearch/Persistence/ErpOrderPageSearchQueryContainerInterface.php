<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Persistence;

use Orm\Zed\ErpOrder\Persistence\ErpOrderQuery;

interface ErpOrderPageSearchQueryContainerInterface
{
    /**
     * @param int[] $erpOrderIds
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @return \Orm\Zed\ErpOrder\Persistence\ErpOrderQuery
     */
    public function queryErpOrdersByErpOrderIds(
        array $erpOrderIds
    ): ErpOrderQuery;

    /**
     * @param int[] $erpOrderIds
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @return \Orm\Zed\ErpOrder\Persistence\ErpOrderQuery
     */
    public function queryErpOrderWithAddressesAndCompanyBusinessUnitByErpOrderIds(
        array $erpOrderIds
    ): ErpOrderQuery;
}
