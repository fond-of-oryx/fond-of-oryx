<?php

namespace FondOfOryx\Zed\CompanyProductListConnectorExtension\Dependency\Plugin;

use Generated\Shared\Transfer\CompanyProductListRelationTransfer;

interface CompanyProductListRelationPostPersistPluginInterface
{
    /**
     * Specifications:
     * - Executes after company product list relation has been persisted
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyProductListRelationTransfer $companyProductListRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyProductListRelationTransfer
     */
    public function postPersist(
        CompanyProductListRelationTransfer $companyProductListRelationTransfer
    ): CompanyProductListRelationTransfer;
}
