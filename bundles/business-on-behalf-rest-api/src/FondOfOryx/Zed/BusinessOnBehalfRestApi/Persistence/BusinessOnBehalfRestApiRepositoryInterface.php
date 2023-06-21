<?php

namespace FondOfOryx\Zed\BusinessOnBehalfRestApi\Persistence;

interface BusinessOnBehalfRestApiRepositoryInterface
{
    /**
     * @param int $idCustomer
     * @param string $companyUserReference
     *
     * @return int|null
     */
    public function getIdCompanyUserByIdCustomerAndCompanyUserReference(
        int $idCustomer,
        string $companyUserReference
    ): ?int;
}
