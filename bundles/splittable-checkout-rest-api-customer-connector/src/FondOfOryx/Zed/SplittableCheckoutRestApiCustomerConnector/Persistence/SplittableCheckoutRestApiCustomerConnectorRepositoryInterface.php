<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Persistence;

use Generated\Shared\Transfer\CustomerTransfer;

interface SplittableCheckoutRestApiCustomerConnectorRepositoryInterface
{
    /**
     * @param string $customerReference
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    public function getCustomerByCustomerReference(string $customerReference): ?CustomerTransfer;
}
