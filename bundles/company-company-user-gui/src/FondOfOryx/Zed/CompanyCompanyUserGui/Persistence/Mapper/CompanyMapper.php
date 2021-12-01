<?php

namespace FondOfOryx\Zed\CompanyCompanyUserGui\Persistence\Mapper;

use Generated\Shared\Transfer\CompanyTransfer;
use Orm\Zed\Company\Persistence\SpyCompany;
use Propel\Runtime\Collection\ObjectCollection;

class CompanyMapper implements CompanyMapperInterface
{
    /**
     * @param \Orm\Zed\Company\Persistence\SpyCompany $entity
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function mapEntityToTransfer(SpyCompany $entity): CompanyTransfer
    {
        return (new CompanyTransfer())
            ->fromArray($entity->toArray(), true);
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection $entityCollection
     *
     * @return array<\Generated\Shared\Transfer\CompanyTransfer>
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
