<?php

namespace FondOfOryx\Zed\CustomerStatistic\Persistence;

use Generated\Shared\Transfer\CustomerStatisticTransfer;

interface CustomerStatisticRepositoryInterface
{
    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticTransfer|null
     */
    public function getCustomerStatisticByIdCustomer(int $idCustomer): ?CustomerStatisticTransfer;

    /**
     * @param string $customerReference
     *
     * @return int|null
     */
    public function getIdCustomerByCustomerReference(string $customerReference): ?int;
}
