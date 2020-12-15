<?php

namespace FondOfOryx\Zed\CustomerStatistic\Business;

use Generated\Shared\Transfer\CustomerStatisticResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerStatisticFacadeInterface
{
    /**
     * Specifications:
     * - Increments login count by CustomerTransfer::customerReference in the transfer
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticResponseTransfer
     */
    public function incrementLoginCount(
        CustomerTransfer $customerTransfer
    ): CustomerStatisticResponseTransfer;

    /**
     * Specifications:
     * - Expands customer transfer with statistic data
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function expandCustomer(CustomerTransfer $customerTransfer): CustomerTransfer;
}
