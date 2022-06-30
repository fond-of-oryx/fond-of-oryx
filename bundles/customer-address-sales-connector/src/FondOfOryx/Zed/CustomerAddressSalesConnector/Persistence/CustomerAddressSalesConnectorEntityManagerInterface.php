<?php

namespace FondOfOryx\Zed\CustomerAddressSalesConnector\Persistence;

interface CustomerAddressSalesConnectorEntityManagerInterface
{
    /**
     * @param int $idSalesOrder
     * @param int $idCustomerAddress
     *
     * @return void
     */
    public function updateFkResourceCustomerAddressForSalesOrderAddress(
        int $idSalesOrder,
        int $idCustomerAddress
    ): void;
}
