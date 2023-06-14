<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade;

use Generated\Shared\Transfer\CompanyTypeTransfer;

interface RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\CompanyTypeTransfer|null
     */
    public function getCompanyTypeManufacturer(): ?CompanyTypeTransfer;
}
