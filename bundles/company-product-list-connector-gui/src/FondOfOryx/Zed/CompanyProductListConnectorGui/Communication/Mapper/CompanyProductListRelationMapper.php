<?php

namespace FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Mapper;

use Generated\Shared\Transfer\CompanyProductListConnectorFormTransfer;
use Generated\Shared\Transfer\CompanyProductListRelationTransfer;

class CompanyProductListRelationMapper implements CompanyProductListRelationMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyProductListConnectorFormTransfer $companyProductListConnectorFormTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyProductListRelationTransfer
     */
    public function fromCompanyProductListConnectorGui(
        CompanyProductListConnectorFormTransfer $companyProductListConnectorFormTransfer
    ): CompanyProductListRelationTransfer {
        $productListIdsToAssigned = $companyProductListConnectorFormTransfer->getProductListIdsToAssign();
        $productListIdsToDeAssigned = $companyProductListConnectorFormTransfer->getProductListIdsToDeAssign();
        $assignedProductListIds = $companyProductListConnectorFormTransfer->getAssignedProductListIds();

        $assignedProductListIds = array_unique(array_merge($assignedProductListIds, $productListIdsToAssigned));
        $assignedProductListIds = array_diff($assignedProductListIds, $productListIdsToDeAssigned);
        $assignedProductListIds = array_values($assignedProductListIds);
        sort($assignedProductListIds, SORT_NUMERIC);

        return (new CompanyProductListRelationTransfer())
            ->setIdCompany($companyProductListConnectorFormTransfer->getIdCompany())
            ->setProductListIds($assignedProductListIds);
    }
}
