<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit;

class CompanyBusinessUnitMapper implements CompanyBusinessUnitMapperInterface
{
    /**
     * @param \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit $entity
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $transfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    public function mapEntityToTransfer(
        SpyCompanyBusinessUnit $entity,
        CompanyBusinessUnitTransfer $transfer
    ): CompanyBusinessUnitTransfer {
        return $transfer->fromArray($entity->toArray());
    }
}
