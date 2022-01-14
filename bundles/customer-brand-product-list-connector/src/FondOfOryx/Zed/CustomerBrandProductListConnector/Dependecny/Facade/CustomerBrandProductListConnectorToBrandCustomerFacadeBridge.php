<?php

namespace FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade;

use FondOfSpryker\Zed\BrandCustomer\Business\BrandCustomerFacadeInterface;
use Generated\Shared\Transfer\CustomerBrandRelationTransfer;

class CustomerBrandProductListConnectorToBrandCustomerFacadeBridge implements
    CustomerBrandProductListConnectorToBrandCustomerFacadeInterface
{
 /**
  * @var \FondOfSpryker\Zed\BrandCustomer\Business\BrandCustomerFacadeInterface
  */
    protected $brandCustomerFacade;

    /**
     * @param \FondOfSpryker\Zed\BrandCustomer\Business\BrandCustomerFacadeInterface $brandCustomerFacade
     */
    public function __construct(BrandCustomerFacadeInterface $brandCustomerFacade)
    {
        $this->brandCustomerFacade = $brandCustomerFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerBrandRelationTransfer $customerBrandRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerBrandRelationTransfer
     */
    public function saveCustomerBrandRelation(
        CustomerBrandRelationTransfer $customerBrandRelationTransfer
    ): CustomerBrandRelationTransfer {
        return $this->brandCustomerFacade->saveCustomerBrandRelation($customerBrandRelationTransfer);
    }
}
