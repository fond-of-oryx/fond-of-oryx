<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Persistence;

use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery;

interface ErpInvoicePageSearchQueryContainerInterface
{
    /**
     * @param array<int> $erpInvoiceIds
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @return \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery
     */
    public function queryErpInvoicesByErpInvoiceIds(
        array $erpInvoiceIds
    ): FooErpInvoiceQuery;

    /**
     * @param array<int> $erpInvoiceIds
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @return \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery
     */
    public function queryErpInvoiceWithAddressesAndCompanyBusinessUnitByErpInvoiceIds(
        array $erpInvoiceIds
    ): FooErpInvoiceQuery;
}
