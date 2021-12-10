<?php

namespace FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Form\DataProvider;

use FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Facade\CustomerProductListConnectorGuiToCustomerProductListConnectorFacadeInterface;
use Generated\Shared\Transfer\CustomerProductListConnectorFormTransfer;

class CustomerProductListConnectorFormDataProvider implements CustomerProductListConnectorFormDataProviderInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Facade\CustomerProductListConnectorGuiToCustomerProductListConnectorFacadeInterface
     */
    protected $customerProductListConnectorFacade;

    /**
     * @param \FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Facade\CustomerProductListConnectorGuiToCustomerProductListConnectorFacadeInterface $customerProductListConnectorFacade
     */
    public function __construct(
        CustomerProductListConnectorGuiToCustomerProductListConnectorFacadeInterface $customerProductListConnectorFacade
    ) {
        $this->customerProductListConnectorFacade = $customerProductListConnectorFacade;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return [
            'data_class' => CustomerProductListConnectorFormTransfer::class,
        ];
    }

    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CustomerProductListConnectorFormTransfer
     */
    public function getData(int $idCustomer): CustomerProductListConnectorFormTransfer
    {
        $assignedProductListIds = $this->customerProductListConnectorFacade->getAssignedProductListIdsByIdCustomer(
            $idCustomer,
        );

        return (new CustomerProductListConnectorFormTransfer())
            ->setIdCustomer($idCustomer)
            ->setAssignedProductListIds($assignedProductListIds);
    }
}
