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

        /** @var \Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUser $representativeCompanyUserTradeFairEntity */
        foreach ($entity->getFooRepresentativeCompanyUsers()->getData() as $representativeCompanyUserTradeFairEntity) {
            $representativeCompanyUserTransfer = (new RepresentativeCompanyUserTransfer())
                ->fromArray($representativeCompanyUserTradeFairEntity->toArray(), true)
                ->setRepresentative($this->mapCustomer($representativeCompanyUserTradeFairEntity->getFooRepresentativeCompanyUserRepresentative()))
                ->setDistributor($this->mapCustomer($representativeCompanyUserTradeFairEntity->getFooRepresentativeCompanyUserDistributor()))
                ->setOriginator($this->mapCustomer($representativeCompanyUserTradeFairEntity->getFooRepresentativeCompanyUserOriginator()));
            $representativeCompanyUserTradeFairTransfer->addRepresentativeCompanyUser($representativeCompanyUserTransfer);
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
