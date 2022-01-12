<?php

namespace FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade;

use FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacadeInterface;
use Generated\Shared\Transfer\CompanyBrandRelationTransfer;

class CompanyBrandProductListConnectorToBrandCompanyFacadeBridge implements
    CompanyBrandProductListConnectorToBrandCompanyFacadeInterface
{
 /**
  * @var \FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacadeInterface
  */
    protected $brandCompanyFacade;

    /**
     * @param \FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacadeInterface $brandCompanyFacade
     */
    public function __construct(BrandCompanyFacadeInterface $brandCompanyFacade)
    {
        $this->brandCompanyFacade = $brandCompanyFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer $companyBrandRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBrandRelationTransfer
     */
    public function saveCompanyBrandRelation(
        CompanyBrandRelationTransfer $companyBrandRelationTransfer
    ): CompanyBrandRelationTransfer {
        return $this->brandCompanyFacade->saveCompanyBrandRelation($companyBrandRelationTransfer);
    }
}
