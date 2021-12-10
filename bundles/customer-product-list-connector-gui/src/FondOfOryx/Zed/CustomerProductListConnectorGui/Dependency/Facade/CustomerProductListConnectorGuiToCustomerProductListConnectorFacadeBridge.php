<?php

namespace FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Facade;

use FondOfOryx\Zed\CustomerProductListConnector\Business\CustomerProductListConnectorFacadeInterface;
use Generated\Shared\Transfer\CustomerProductListRelationTransfer;

class CustomerProductListConnectorGuiToCustomerProductListConnectorFacadeBridge implements CustomerProductListConnectorGuiToCustomerProductListConnectorFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnector\Business\CustomerProductListConnectorFacadeInterface
     */
    protected $customerProductListConnectorFacade;

    /**
     * @param \FondOfOryx\Zed\CustomerProductListConnector\Business\CustomerProductListConnectorFacadeInterface $customerProductListConnectorFacade
     */
    public function __construct(CustomerProductListConnectorFacadeInterface $customerProductListConnectorFacade)
    {
        $this->customerProductListConnectorFacade = $customerProductListConnectorFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerProductListRelationTransfer $customerProductListRelationTransfer
     *
     * @return void
     */
    public function persistCustomerProductListRelation(
        CustomerProductListRelationTransfer $customerProductListRelationTransfer
    ): void {
        $this->customerProductListConnectorFacade->persistCustomerProductListRelation(
            $customerProductListRelationTransfer,
        );
    }

    /**
     * @param int $idCustomer
     *
     * @return array<int>
     */
    public function getAssignedProductListIdsByIdCustomer(int $idCustomer): array
    {
        return $this->customerProductListConnectorFacade->getAssignedProductListIdsByIdCustomer($idCustomer);
    }
}
