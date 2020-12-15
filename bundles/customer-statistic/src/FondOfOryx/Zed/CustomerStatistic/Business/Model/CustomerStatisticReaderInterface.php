<?php

namespace FondOfOryx\Zed\CustomerStatistic\Business\Model;

use Generated\Shared\Transfer\CustomerStatisticResponseTransfer;
use Generated\Shared\Transfer\CustomerStatisticTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerStatisticReaderInterface
{
    /**
     * @param string $customerReference
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticTransfer|null
     */
    public function getByCustomerReference(string $customerReference): ?CustomerStatisticTransfer;

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticResponseTransfer
     */
    public function findByCustomerReference(CustomerTransfer $customerTransfer): CustomerStatisticResponseTransfer;
}
