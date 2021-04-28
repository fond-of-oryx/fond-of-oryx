<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Persistence;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

interface ReturnLabelsRestApiRepositoryInterface
{
    /**
     * @param null|string $uuid
     *
     * @return CompanyUnitAddressTransfer
     */
    public function getCompanyUnitAddressByCompanyUnitAddressUuid(string $uuid): ?CompanyUnitAddressTransfer;
}
