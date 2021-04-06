<?php

namespace FondOfOryx\Zed\ReturnLabel\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress;

class CompanyUnitAddressMapper implements CompanyUnitAddressMapperInterface
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
    ): CompanyUnitAddressTransfer {
        return $transfer->fromArray($entity->toArray(), true);
    }
}
