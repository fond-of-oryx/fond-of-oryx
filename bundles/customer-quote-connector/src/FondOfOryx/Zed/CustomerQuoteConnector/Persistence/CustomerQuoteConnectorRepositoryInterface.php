<?php

namespace FondOfOryx\Zed\CustomerQuoteConnector\Persistence;

interface CustomerQuoteConnectorRepositoryInterface
{
    /**
     * @param string $customerReference
     *
     * @return int|null
     */
    public function getIdCustomerByCustomerReference(string $customerReference): ?int;
}
