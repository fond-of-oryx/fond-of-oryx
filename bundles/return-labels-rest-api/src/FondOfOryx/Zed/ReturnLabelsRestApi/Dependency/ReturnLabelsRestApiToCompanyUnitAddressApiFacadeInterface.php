<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Dependency;

use Generated\Shared\Transfer\ApiItemTransfer;

interface ReturnLabelsRestApiToCompanyUnitAddressApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idCompanyUnitAddress
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function getCompanyUnitAddress(int $idCompanyUnitAddress): ApiItemTransfer;
}
