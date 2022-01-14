<?php

namespace FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade;

use FondOfOryx\Zed\BrandProductListConnector\Business\BrandProductListConnectorFacadeInterface;

class CustomerBrandProductListConnectorToBrandProductListConnectorFacadeBridge implements
    CustomerBrandProductListConnectorToBrandProductListConnectorFacadeInterface
{
 /**
  * @var \FondOfOryx\Zed\BrandProductListConnector\Business\BrandProductListConnectorFacadeInterface
  */
    protected $brandProductListConnectorFacade;

    /**
     * @param \FondOfOryx\Zed\BrandProductListConnector\Business\BrandProductListConnectorFacadeInterface $brandProductListConnectorFacade
     */
    public function __construct(
        BrandProductListConnectorFacadeInterface $brandProductListConnectorFacade
    ) {
        $this->brandProductListConnectorFacade = $brandProductListConnectorFacade;
    }

    /**
     * @param array<int> $productListIds
     *
     * @return array<int>
     */
    public function getBrandIdsByProductListIds(array $productListIds): array
    {
        return $this->brandProductListConnectorFacade->getBrandIdsByProductListIds($productListIds);
    }
}
