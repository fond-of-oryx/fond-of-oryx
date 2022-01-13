<?php

namespace FondOfOryx\Zed\CustomerProductListConnectorExtension\Dependency\Plugin;

use Generated\Shared\Transfer\CustomerProductListRelationTransfer;

interface CustomerProductListRelationPostPersistPluginInterface
{
    /**
     * Specifications:
     * - Executes after company product list relation has been persisted
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerProductListRelationTransfer $customerProductListRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerProductListRelationTransfer
     */
    public function postPersist(
        CustomerProductListRelationTransfer $customerProductListRelationTransfer
    ): CustomerProductListRelationTransfer;
}
