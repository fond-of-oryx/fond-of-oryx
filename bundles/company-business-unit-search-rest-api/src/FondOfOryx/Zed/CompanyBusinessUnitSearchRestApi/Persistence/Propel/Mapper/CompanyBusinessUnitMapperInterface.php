<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitSearchRestApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit;
use Propel\Runtime\Collection\ObjectCollection;

interface CompanyBusinessUnitMapperInterface
{
    /**
     * @param \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit $entity
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    public function mapEntityToTransfer(SpyCompanyBusinessUnit $entity): CompanyBusinessUnitTransfer;

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection|\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit[] $entityCollection
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer[]
     */
    public function mapEntityCollectionToTransfers(ObjectCollection $entityCollection): array;
}
