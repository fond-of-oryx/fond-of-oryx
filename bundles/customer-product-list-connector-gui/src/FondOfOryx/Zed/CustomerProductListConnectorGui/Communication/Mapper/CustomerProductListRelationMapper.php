<?php

namespace FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Mapper;

use Generated\Shared\Transfer\CustomerProductListConnectorFormTransfer;
use Generated\Shared\Transfer\CustomerProductListRelationTransfer;

class CustomerProductListRelationMapper implements CustomerProductListRelationMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerProductListConnectorFormTransfer $customerProductListConnectorFormTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerProductListRelationTransfer
     */
    public function fromCustomerProductListConnectorGui(
        CustomerProductListConnectorFormTransfer $customerProductListConnectorFormTransfer
    ): CustomerProductListRelationTransfer {
        $productListIdsToAssigned = $customerProductListConnectorFormTransfer->getProductListIdsToAssign();
        $productListIdsToDeAssigned = $customerProductListConnectorFormTransfer->getProductListIdsToDeAssign();
        $assignedProductListIds = $customerProductListConnectorFormTransfer->getAssignedProductListIds();

        $assignedProductListIds = array_unique(array_merge($assignedProductListIds, $productListIdsToAssigned));
        $assignedProductListIds = array_diff($assignedProductListIds, $productListIdsToDeAssigned);
        $assignedProductListIds = array_values($assignedProductListIds);
        sort($assignedProductListIds, SORT_NUMERIC);

        return (new CustomerProductListRelationTransfer())
            ->setIdCustomer($customerProductListConnectorFormTransfer->getIdCustomer())
            ->setProductListIds($assignedProductListIds);
    }
}
