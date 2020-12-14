<?php

namespace FondOfOryx\Client\CustomerStatistic\Zed;

use Generated\Shared\Transfer\CustomerStatisticResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerStatisticZedStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticResponseTransfer
     */
    public function incrementLoginCount(CustomerTransfer $customerTransfer): CustomerStatisticResponseTransfer;
}
