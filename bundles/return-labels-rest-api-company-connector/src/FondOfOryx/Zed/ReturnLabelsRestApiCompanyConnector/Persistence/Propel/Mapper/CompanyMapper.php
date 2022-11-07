<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CompanyTransfer;
use Orm\Zed\Company\Persistence\SpyCompany;

class CompanyMapper implements CompanyMapperInterface
{
    /**
     * @param \Orm\Zed\Company\Persistence\SpyCompany $entity
     * @param \Generated\Shared\Transfer\CompanyTransfer $transfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function mapEntityToTransfer(SpyCompany $entity, CompanyTransfer $transfer): CompanyTransfer
    {
        return $transfer->fromArray($entity->toArray());
    }
}
