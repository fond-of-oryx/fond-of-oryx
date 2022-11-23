<?php

namespace FondOfOryx\Zed\CompanyProductListsRestApi\Business\Filter;

use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

interface CompanyIdsFilterInterface
{
    /**
     * @param array<int> $assignedCompanyIds
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     *
     * @return array<int>
     */
    public function filter(
        array $assignedCompanyIds,
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
    ): array;
}
