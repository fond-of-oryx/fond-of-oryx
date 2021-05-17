<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress;

interface CompanyUnitAddressMapperInterface
{
    /**
     * @param \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress $entity
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $transfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    public function mapEntityToTransfer(
        SpyCompanyUnitAddress $entity,
        CompanyUnitAddressTransfer $transfer
    ): CompanyUnitAddressTransfer;
}
