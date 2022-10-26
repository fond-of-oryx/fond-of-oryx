<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi\Business\Filter;

use Generated\Shared\Transfer\RestProductListsAttributesTransfer;

interface CustomerIdsFilterInterface
{
    /**
     * @param array<int> $assignedCustomerIds
     * @param \Generated\Shared\Transfer\RestProductListsAttributesTransfer $restProductListsAttributesTransfer
     *
     * @return array<int>
     */
    public function filter(
        array $assignedCustomerIds,
        RestProductListsAttributesTransfer $restProductListsAttributesTransfer
    ): array;
}
