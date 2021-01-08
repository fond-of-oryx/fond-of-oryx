<?php

namespace FondOfOryx\Zed\CustomerStatistic\Business\Model;

use Generated\Shared\Transfer\CustomerStatisticResponseTransfer;
use Generated\Shared\Transfer\CustomerStatisticTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerStatisticReaderInterface
{
    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticTransfer|null
     */
    public function getByIdCustomer(int $idCustomer): ?CustomerStatisticTransfer;

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticResponseTransfer
     */
    public function findByIdCustomer(CustomerTransfer $customerTransfer): CustomerStatisticResponseTransfer;
}
