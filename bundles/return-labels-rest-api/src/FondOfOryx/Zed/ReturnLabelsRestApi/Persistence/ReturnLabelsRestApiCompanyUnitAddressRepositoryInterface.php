<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Persistence;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

interface ReturnLabelsRestApiCompanyUnitAddressRepositoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $externalReference
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer|null
     */
    public function findCompanyUnitAddressByExternalReference(string $externalReference): ?CompanyUnitAddressTransfer;
}
