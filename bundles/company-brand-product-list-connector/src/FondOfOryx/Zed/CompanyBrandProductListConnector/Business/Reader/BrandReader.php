<?php

namespace FondOfOryx\Zed\CompanyBrandProductListConnector\Business\Reader;

use FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandProductListConnectorFacadeInterface;
use Generated\Shared\Transfer\CompanyProductListRelationTransfer;

class BrandReader implements BrandReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandProductListConnectorFacadeInterface
     */
    protected $brandProductListConnectorFacade;

    /**
     * @param \FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandProductListConnectorFacadeInterface $brandProductListConnectorFacade
     */
    public function __construct(
        CompanyBrandProductListConnectorToBrandProductListConnectorFacadeInterface $brandProductListConnectorFacade
    ) {
        $this->brandProductListConnectorFacade = $brandProductListConnectorFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyProductListRelationTransfer $companyProductListRelationTransfer
     *
     * @return array<int>
     */
    public function getBrandIdsByCompanyProductListRelation(
        CompanyProductListRelationTransfer $companyProductListRelationTransfer
    ): array {
        $productListIds = $companyProductListRelationTransfer->getProductListIds();

        if (count($productListIds) === 0) {
            return [];
        }

        return $this->brandProductListConnectorFacade->getBrandIdsByProductListIds($productListIds);
    }
}
