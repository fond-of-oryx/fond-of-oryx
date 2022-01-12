<?php

namespace FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade;

use Generated\Shared\Transfer\CompanyBrandRelationTransfer;

interface CompanyBrandProductListConnectorToBrandCompanyFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer $companyBrandRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBrandRelationTransfer
     */
    public function saveCompanyBrandRelation(
        CompanyBrandRelationTransfer $companyBrandRelationTransfer
    ): CompanyBrandRelationTransfer;
}
