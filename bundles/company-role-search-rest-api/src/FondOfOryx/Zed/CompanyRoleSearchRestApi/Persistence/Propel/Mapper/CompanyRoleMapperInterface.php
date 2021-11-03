<?php

namespace FondOfOryx\Zed\CompanyRoleSearchRestApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CompanyRoleTransfer;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRole;
use Propel\Runtime\Collection\ObjectCollection;

interface CompanyRoleMapperInterface
{
    /**
     * @param \Orm\Zed\CompanyRole\Persistence\SpyCompanyRole $entity
     *
     * @return \Generated\Shared\Transfer\CompanyRoleTransfer
     */
    public function mapEntityToTransfer(SpyCompanyRole $entity): CompanyRoleTransfer;

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection $entityCollection
     *
     * @return array<\Generated\Shared\Transfer\CompanyRoleTransfer>
     */
    public function mapEntityCollectionToTransfers(ObjectCollection $entityCollection): array;
}
