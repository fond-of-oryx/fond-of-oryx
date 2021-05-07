<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Persistence;

use Generated\Shared\Transfer\CustomerTransfer;

interface ReturnLabelsRestApiCustomerConnectorRepositoryInterface
{
    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    public function getCustomerById(int $idCustomer): ?CustomerTransfer;
}
