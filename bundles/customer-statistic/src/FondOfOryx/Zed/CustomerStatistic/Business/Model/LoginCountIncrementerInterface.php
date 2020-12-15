<?php

namespace FondOfOryx\Zed\CustomerStatistic\Business\Model;

use Generated\Shared\Transfer\CustomerStatisticResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

interface LoginCountIncrementerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticResponseTransfer
     */
    public function increment(CustomerTransfer $customerTransfer): CustomerStatisticResponseTransfer;
}
