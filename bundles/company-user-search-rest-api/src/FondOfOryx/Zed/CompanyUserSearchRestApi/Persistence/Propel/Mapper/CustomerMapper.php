<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CustomerTransfer;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUser;
use Orm\Zed\Customer\Persistence\SpyCustomer;

class CustomerMapper implements CustomerMapperInterface
{
    /**
     * @param \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser $companyUserEntity
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function mapCompanyUserEntityToTransfer(SpyCompanyUser $companyUserEntity): CustomerTransfer
    {
        return $this->mapEntityToTransfer($companyUserEntity->getCustomer());
    }

    /**
     * @param \Orm\Zed\Customer\Persistence\SpyCustomer $entity
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function mapEntityToTransfer(SpyCustomer $entity): CustomerTransfer
    {
        return (new CustomerTransfer())
            ->fromArray($entity->toArray(), true);
    }
}
