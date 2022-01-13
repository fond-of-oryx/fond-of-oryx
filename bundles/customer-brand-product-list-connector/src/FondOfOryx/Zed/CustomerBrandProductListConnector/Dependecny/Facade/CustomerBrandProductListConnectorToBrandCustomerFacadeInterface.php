<?php

namespace FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade;

use Generated\Shared\Transfer\CustomerBrandRelationTransfer;

interface CustomerBrandProductListConnectorToBrandCustomerFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerBrandRelationTransfer $customerBrandRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerBrandRelationTransfer
     */
    public function saveCustomerBrandRelation(
        CustomerBrandRelationTransfer $customerBrandRelationTransfer
    ): CustomerBrandRelationTransfer;
}
