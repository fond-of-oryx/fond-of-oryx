<?php


namespace FondOfOryx\Zed\ReturnLabel\Persistence;


use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

interface ReturnLabelRepositoryInterface
{
    /**
     * @param string $companyBusinessUnitUuid
     * @param string $companyBusinessUnitAddressUuid
     *
     * @return CompanyUnitAddressTransfer|null
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findCompanyBusinessUnitAddressByUuidAndCompany(
        string $companyBusinessUnitUuid,
        string $companyBusinessUnitAddressUuid
    ): ?CompanyUnitAddressTransfer;
}
