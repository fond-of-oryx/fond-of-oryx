<?php

namespace FondOfOryx\Zed\CompanyBrandProductListConnector\Business\Reader;

use Generated\Shared\Transfer\CompanyProductListRelationTransfer;

interface BrandReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyProductListRelationTransfer $companyProductListRelationTransfer
     *
     * @return array<int>
     */
    public function getBrandIdsByCompanyProductListRelation(
        CompanyProductListRelationTransfer $companyProductListRelationTransfer
    ): array;
}
