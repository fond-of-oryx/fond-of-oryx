<?php

namespace FondOfOryx\Zed\CompanyBrandProductListConnector\Business;

use Generated\Shared\Transfer\CompanyProductListRelationTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyBrandProductListConnector\Business\CompanyBrandProductListConnectorBusinessFactory getFactory()
 */
class CompanyBrandProductListConnectorFacade extends AbstractFacade implements CompanyBrandProductListConnectorFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyProductListRelationTransfer $companyProductListRelationTransfer
     *
     * @return void
     */
    public function persistCompanyBrandRelationByCompanyProductListRelation(
        CompanyProductListRelationTransfer $companyProductListRelationTransfer
    ): void {
        $this->getFactory()
            ->createCompanyBrandRelationPersister()
            ->persistByCompanyProductListRelation($companyProductListRelationTransfer);
    }
}
