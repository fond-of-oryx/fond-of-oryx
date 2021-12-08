<?php

namespace FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Mapper;

use Generated\Shared\Transfer\CompanyProductListConnectorFormTransfer;
use Generated\Shared\Transfer\CompanyProductListRelationTransfer;

interface CompanyProductListRelationMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyProductListConnectorFormTransfer $companyProductListConnectorFormTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyProductListRelationTransfer
     */
    public function fromCompanyProductListConnectorGui(
        CompanyProductListConnectorFormTransfer $companyProductListConnectorFormTransfer
    ): CompanyProductListRelationTransfer;
}
