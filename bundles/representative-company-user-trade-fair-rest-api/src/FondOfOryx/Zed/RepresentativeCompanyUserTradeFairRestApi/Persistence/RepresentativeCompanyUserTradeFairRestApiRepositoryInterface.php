<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Persistence;

interface RepresentativeCompanyUserTradeFairRestApiRepositoryInterface
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
