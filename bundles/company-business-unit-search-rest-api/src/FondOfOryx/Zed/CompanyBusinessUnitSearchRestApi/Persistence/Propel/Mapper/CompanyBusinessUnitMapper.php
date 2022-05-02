<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitSearchRestApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit;
use Propel\Runtime\Collection\ObjectCollection;

class CompanyBusinessUnitMapper implements CompanyBusinessUnitMapperInterface
{
    /**
     * @param \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit $entity
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    public function mapEntityToTransfer(SpyCompanyBusinessUnit $entity): CompanyBusinessUnitTransfer
    {
        return (new CompanyBusinessUnitTransfer())
            ->fromArray($entity->toArray(), true)
            ->setCompanyUuid($entity->getCompany()->getUuid());
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit> $entityCollection
     *
     * @return array<\Generated\Shared\Transfer\CompanyBusinessUnitTransfer>
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
