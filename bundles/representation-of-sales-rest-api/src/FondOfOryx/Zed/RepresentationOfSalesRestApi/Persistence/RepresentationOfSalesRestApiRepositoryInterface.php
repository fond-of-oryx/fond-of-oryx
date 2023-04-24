<?php

namespace FondOfOryx\Zed\RepresentationOfSalesRestApi\Persistence;

interface RepresentationOfSalesRestApiRepositoryInterface
{
    /**
     * @param string $customerReference
     *
     * @throws \Exception
     *
     * @return int
     */
    public function getIdCustomerByReference(string $customerReference): int;
}
