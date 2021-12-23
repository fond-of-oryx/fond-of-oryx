<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CompanyRoleTransfer;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRole;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUser;

interface CompanyRoleMapperInterface
{
    /**
     * @param \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser $companyUserEntity
     *
     * @return array<\Generated\Shared\Transfer\CompanyRoleTransfer>
     */
    public function mapCompanyUserEntityToTransfer(SpyCompanyUser $companyUserEntity): array;

    /**
     * @param \Orm\Zed\CompanyRole\Persistence\SpyCompanyRole $entity
     *
     * @return \Generated\Shared\Transfer\CompanyRoleTransfer
     */
    public function mapEntityToTransfer(SpyCompanyRole $entity): CompanyRoleTransfer;
}
