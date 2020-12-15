<?php

namespace FondOfOryx\Zed\CustomerStatistic\Persistence;

use Generated\Shared\Transfer\CustomerStatisticTransfer;

interface CustomerStatisticRepositoryInterface
{
    /**
     * @param string $customerReference
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticTransfer|null
     */
    public function getCustomerStatisticByCustomerReference(string $customerReference): ?CustomerStatisticTransfer;
}
