<?php

namespace FondOfOryx\Zed\ReturnLabelRestApi\Dependency;

use Generated\Shared\Transfer\ApiItemTransfer;

interface ReturnLabelRestApiToCompanyUnitAddressApiFacadeInterface
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
