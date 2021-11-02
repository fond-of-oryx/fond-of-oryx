<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CompanyUserTransfer;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUser;
use Propel\Runtime\Collection\ObjectCollection;

class CompanyUserMapper implements CompanyUserMapperInterface
{
    /**
     * @param \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser $entity
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function mapEntityToTransfer(SpyCompanyUser $entity): CompanyUserTransfer
    {
        return (new CompanyUserTransfer())
            ->fromArray($entity->toArray(), true)
            ->setCustomerReference($entity->getCustomer()->getCustomerReference())
            ->setCompanyUuid($entity->getCompany()->getUuid());
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection|\Orm\Zed\CompanyUser\Persistence\SpyCompanyUser[] $entityCollection
     *
     * @return array<\Generated\Shared\Transfer\CompanyUserTransfer>
     */
    public function mapEntityCollectionToTransfers(ObjectCollection $entityCollection): array
    {
        $transfers = [];

        foreach ($entityCollection as $entity) {
            $transfers[] = $this->mapEntityToTransfer($entity);
        }

        return $transfers;
    }
}
