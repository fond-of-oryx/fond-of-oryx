<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade;

use Generated\Shared\Transfer\CompanyTypeTransfer;

interface RepresentativeCompanyUserTradeFairRestApiToCompanyTypeInterface
{
    /**
     * @return \Generated\Shared\Transfer\CompanyTypeTransfer|null
     */
    public function getCompanyTypeManufacturer(): ?CompanyTypeTransfer;
}
