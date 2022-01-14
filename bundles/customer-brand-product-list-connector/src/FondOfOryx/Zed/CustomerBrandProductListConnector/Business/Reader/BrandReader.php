<?php

namespace FondOfOryx\Zed\CustomerBrandProductListConnector\Business\Reader;

use FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade\CustomerBrandProductListConnectorToBrandProductListConnectorFacadeInterface;
use Generated\Shared\Transfer\CustomerProductListRelationTransfer;

class BrandReader implements BrandReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade\CustomerBrandProductListConnectorToBrandProductListConnectorFacadeInterface
     */
    protected $brandProductListConnectorFacade;

    /**
     * @param \FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade\CustomerBrandProductListConnectorToBrandProductListConnectorFacadeInterface $brandProductListConnectorFacade
     */
    public function __construct(
        CustomerBrandProductListConnectorToBrandProductListConnectorFacadeInterface $brandProductListConnectorFacade
    ) {
        $this->brandProductListConnectorFacade = $brandProductListConnectorFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerProductListRelationTransfer $customerProductListRelationTransfer
     *
     * @return array<int>
     */
    public function getBrandIdsByCustomerProductListRelation(
        CustomerProductListRelationTransfer $customerProductListRelationTransfer
    ): array {
        $productListIds = $customerProductListRelationTransfer->getProductListIds();

        if (count($productListIds) === 0) {
            return [];
        }

        return $this->brandProductListConnectorFacade->getBrandIdsByProductListIds($productListIds);
    }
}
