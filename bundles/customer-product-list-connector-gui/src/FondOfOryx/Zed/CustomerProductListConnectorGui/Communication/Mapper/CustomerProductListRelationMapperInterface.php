<?php

namespace FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Mapper;

use Generated\Shared\Transfer\CustomerProductListConnectorFormTransfer;
use Generated\Shared\Transfer\CustomerProductListRelationTransfer;

interface CustomerProductListRelationMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerProductListConnectorFormTransfer $customerProductListConnectorFormTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerProductListRelationTransfer
     */
    public function fromCustomerProductListConnectorGui(
        CustomerProductListConnectorFormTransfer $customerProductListConnectorFormTransfer
    ): CustomerProductListRelationTransfer;
}
