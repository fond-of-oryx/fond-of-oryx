<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Orm\Zed\Customer\Persistence\SpyCustomer;
use Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUser;
use Orm\Zed\RepresentativeCompanyUserTradeFair\Persistence\FooRepresentativeCompanyUserTradeFair;

class EntityToTransferMapper implements EntityToTransferMapperInterface
{
    /**
     * @param \Orm\Zed\RepresentativeCompanyUserTradeFair\Persistence\FooRepresentativeCompanyUserTradeFair $entity
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function fromRepresentativeCompanyUserTradeFairEntity(FooRepresentativeCompanyUserTradeFair $entity): RepresentativeCompanyUserTradeFairTransfer
    {
        $representativeCompanyUserTradeFairTransfer = (new RepresentativeCompanyUserTradeFairTransfer())
            ->fromArray($entity->toArray(), true)
            ->setDistributor($this->mapCustomer($entity->getFooRepresentativeCompanyUserTradeFairDistributor()));

        foreach ($entity->getFooRepresentativeCompanyUsers()->getData() as $representativeCompanyUserTradeFairEntity) {
            $representativeCompanyUserTradeFairTransfer->addRepresentativeCompanyUser((new RepresentativeCompanyUserTransfer())
                ->fromArray($representativeCompanyUserTradeFairEntity->toArray(), true));
        }

        return $representativeCompanyUserTradeFairTransfer;
    }

    /**
     * @param \Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUser $entity
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function fromRepresentativeCompanyUserEntity(FooRepresentativeCompanyUser $entity): RepresentativeCompanyUserTransfer
    {
        return (new RepresentativeCompanyUserTransfer())
            ->fromArray($entity->toArray(), true)
            ->setRepresentativeCompanyUserTradeFair($this->fromRepresentativeCompanyUserTradeFairEntity($entity->getFooRepresentativeCompanyUserTradeFair()))
            ->setDistributor($this->mapCustomer($entity->getFooRepresentativeCompanyUserDistributor()))
            ->setOriginator($this->mapCustomer($entity->getFooRepresentativeCompanyUserOriginator()))
            ->setRepresentative($this->mapCustomer($entity->getFooRepresentativeCompanyUserRepresentative()));
    }

    /**
     * @param \Orm\Zed\Customer\Persistence\SpyCustomer $customerEntity
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    protected function mapCustomer(SpyCustomer $customerEntity): CustomerTransfer
    {
        return (new CustomerTransfer())->fromArray($customerEntity->toArray(), true);
    }
}
