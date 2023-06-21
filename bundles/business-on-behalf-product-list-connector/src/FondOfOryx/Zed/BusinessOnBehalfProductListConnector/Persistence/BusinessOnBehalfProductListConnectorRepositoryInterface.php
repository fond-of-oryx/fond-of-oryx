<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Persistence;

interface BusinessOnBehalfProductListConnectorRepositoryInterface
{
    /**
     * @param string $customerReference
     *
     * @return int|null
     */
    public function getDefaultIdCompanyUserByCustomerReference(string $customerReference): ?int;

    /**
     * @param string $companyUserReference
     *
     * @return int|null
     */
    public function getIdCompanyUserByCompanyUserReference(string $companyUserReference): ?int;

    /**
     * @param string $customerReference
     *
     * @return int|null
     */
    public function getIdCustomerByCustomerReference(string $customerReference): ?int;
}
