<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader;

use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

interface CompanyUserReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     *
     * @return array<int>
     */
    public function getAuthorizedIdsByRestProductListUpdateRequest(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
    ): array;
}
