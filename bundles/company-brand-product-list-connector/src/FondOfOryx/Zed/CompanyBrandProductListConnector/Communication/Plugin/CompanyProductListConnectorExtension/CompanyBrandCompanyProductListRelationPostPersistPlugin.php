<?php

namespace FondOfOryx\Zed\CompanyBrandProductListConnector\Communication\Plugin\CompanyProductListConnectorExtension;

use FondOfOryx\Zed\CompanyProductListConnectorExtension\Dependency\Plugin\CompanyProductListRelationPostPersistPluginInterface;
use Generated\Shared\Transfer\CompanyProductListRelationTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyBrandProductListConnector\Business\CompanyBrandProductListConnectorFacadeInterface getFacade()
 */
class CompanyBrandCompanyProductListRelationPostPersistPlugin extends AbstractPlugin implements CompanyProductListRelationPostPersistPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyProductListRelationTransfer $companyProductListRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyProductListRelationTransfer
     */
    public function postPersist(
        CompanyProductListRelationTransfer $companyProductListRelationTransfer
    ): CompanyProductListRelationTransfer {
        $this->getFacade()
            ->persistCompanyBrandRelationByCompanyProductListRelation($companyProductListRelationTransfer);

        return $companyProductListRelationTransfer;
    }
}
