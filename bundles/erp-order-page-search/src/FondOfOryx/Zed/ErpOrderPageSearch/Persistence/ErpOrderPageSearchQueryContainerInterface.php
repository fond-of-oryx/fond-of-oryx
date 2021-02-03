<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Persistence;

use Orm\Zed\ErpOrder\Persistence\ErpOrderQuery;

interface ErpOrderPageSearchQueryContainerInterface
{
    /**
     * @param  int[] $erpOrderIds
     *
     * @return \Orm\Zed\ErpOrder\Persistence\ErpOrderQuery
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function queryErpOrdersByErpOrderIds(
        array $erpOrderIds
    ): ErpOrderQuery;

    /**
     * @param  int[]  $erpOrderIds
     *
     * @return \Orm\Zed\ErpOrder\Persistence\ErpOrderQuery
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function queryErpOrderWithAddressesAndCompanyBusinessUnitAndCompanyUserByErpOrderIds(
        array $erpOrderIds
    ): ErpOrderQuery;
}
