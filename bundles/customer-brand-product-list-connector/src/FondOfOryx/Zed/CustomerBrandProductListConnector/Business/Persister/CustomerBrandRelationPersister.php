<?php

namespace FondOfOryx\Zed\CustomerBrandProductListConnector\Business\Persister;

use FondOfOryx\Zed\CustomerBrandProductListConnector\Business\Reader\BrandReaderInterface;
use FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade\CustomerBrandProductListConnectorToBrandCustomerFacadeInterface;
use Generated\Shared\Transfer\CustomerBrandRelationTransfer;
use Generated\Shared\Transfer\CustomerProductListRelationTransfer;

class CustomerBrandRelationPersister implements CustomerBrandRelationPersisterInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerBrandProductListConnector\Business\Reader\BrandReaderInterface
     */
    protected $brandReader;

    /**
     * @var \FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade\CustomerBrandProductListConnectorToBrandCustomerFacadeInterface
     */
    protected $brandCustomerFacade;

    /**
     * @param \FondOfOryx\Zed\CustomerBrandProductListConnector\Business\Reader\BrandReaderInterface $brandReader
     * @param \FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade\CustomerBrandProductListConnectorToBrandCustomerFacadeInterface $brandCustomerFacade
     */
    public function __construct(
        BrandReaderInterface $brandReader,
        CustomerBrandProductListConnectorToBrandCustomerFacadeInterface $brandCustomerFacade
    ) {
        $this->brandReader = $brandReader;
        $this->brandCustomerFacade = $brandCustomerFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerProductListRelationTransfer $customerProductListRelationTransfer
     *
     * @return void
     */
    public function persistByCustomerProductListRelation(
        CustomerProductListRelationTransfer $customerProductListRelationTransfer
    ): void {
        $idCustomer = $customerProductListRelationTransfer->getIdCustomer();

        if ($idCustomer === null) {
            return;
        }

        $brandIds = $this->brandReader->getBrandIdsByCustomerProductListRelation($customerProductListRelationTransfer);

        $customerBrandRelationTransfer = (new CustomerBrandRelationTransfer())
            ->setIdBrands($brandIds)
            ->setIdCustomer($customerProductListRelationTransfer->getIdCustomer());

        $this->brandCustomerFacade->saveCustomerBrandRelation($customerBrandRelationTransfer);
    }
}
