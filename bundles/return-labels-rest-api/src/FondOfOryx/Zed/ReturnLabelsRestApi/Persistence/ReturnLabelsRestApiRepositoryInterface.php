<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Persistence;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

interface ReturnLabelsRestApiRepositoryInterface
{
    /**
     * @param string $externalReference
     * @param array $companyIds
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer|null
     */
    public function findCompanyUnitAddressByExternalReferenceAndCompanyIds(
        string $externalReference,
        array $companyIds
    ): ?CompanyUnitAddressTransfer;
}
