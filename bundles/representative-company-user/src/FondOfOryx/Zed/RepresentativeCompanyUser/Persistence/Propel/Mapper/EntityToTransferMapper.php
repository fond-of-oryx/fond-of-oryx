<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Orm\Zed\Customer\Persistence\SpyCustomer;
use Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUser;

class EntityToTransferMapper implements EntityToTransferMapperInterface
{
    /**
     * @param \Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUser $entity
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function fromRepresentativeCompanyUserEntity(FooRepresentativeCompanyUser $entity): RepresentativeCompanyUserTransfer
    {
        return (new RepresentativeCompanyUserTransfer())
            ->fromArray($entity->toArray(), true)
            ->setDistributor($this->mapCustomer($entity->getFooRepresentativeCompanyUserDistributor()))
            ->setRepresentative($this->mapCustomer($entity->getFooRepresentativeCompanyUserRepresentative()))
            ->setOriginator($this->mapCustomer($entity->getFooRepresentativeCompanyUserOriginator()));
    }

    /**
     * @param \Orm\Zed\Customer\Persistence\SpyCustomer|null $customerEntity
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    protected function mapCustomer(?SpyCustomer $customerEntity): ?CustomerTransfer
    {
        if ($customerEntity === null) {
            return null;
        }

        return (new CustomerTransfer())->fromArray($customerEntity->toArray(), true);
    }
}
