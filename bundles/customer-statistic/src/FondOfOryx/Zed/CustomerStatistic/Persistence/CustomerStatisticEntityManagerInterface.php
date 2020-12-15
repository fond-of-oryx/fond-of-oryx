<?php

namespace FondOfOryx\Zed\CustomerStatistic\Persistence;

use Generated\Shared\Transfer\CustomerStatisticTransfer;

interface CustomerStatisticEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerStatisticTransfer $customerStatisticTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticTransfer
     */
    public function persistCustomerStatistic(
        CustomerStatisticTransfer $customerStatisticTransfer
    ): CustomerStatisticTransfer;
}
