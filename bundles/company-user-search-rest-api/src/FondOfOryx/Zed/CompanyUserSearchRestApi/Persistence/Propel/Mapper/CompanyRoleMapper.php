<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CompanyRoleTransfer;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRole;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUser;

class CompanyRoleMapper implements CompanyRoleMapperInterface
{
    /**
     * @param \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser $companyUserEntity
     *
     * @return array<\Generated\Shared\Transfer\CompanyRoleTransfer>
     */
    public function mapCompanyUserEntityToTransfer(SpyCompanyUser $companyUserEntity): array
    {
        $companyRoleTransfers = [];

        foreach ($companyUserEntity->getSpyCompanyRoleToCompanyUsers() as $companyRoleToCompanyUserEntity) {
            $companyRoleTransfers[] = $this->mapEntityToTransfer($companyRoleToCompanyUserEntity->getCompanyRole());
        }

        return $companyRoleTransfers;
    }

    /**
     * @param \Orm\Zed\CompanyRole\Persistence\SpyCompanyRole $entity
     *
     * @return \Generated\Shared\Transfer\CompanyRoleTransfer
     */
    public function mapEntityToTransfer(SpyCompanyRole $entity): CompanyRoleTransfer
    {
        return (new CompanyRoleTransfer())->fromArray($entity->toArray(), true);
    }
}
