<?php

namespace FondOfOryx\Zed\CompanySearchRestApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CompanyTransfer;
use Orm\Zed\Company\Persistence\Base\SpyCompany;
use Propel\Runtime\Collection\ObjectCollection;

class CompanyMapper implements CompanyMapperInterface
{
    /**
     * @param \Orm\Zed\Company\Persistence\Base\SpyCompany $entity
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function mapEntityToTransfer(SpyCompany $entity): CompanyTransfer
    {
        return (new CompanyTransfer())
            ->fromArray($entity->toArray(), true);
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection|\Orm\Zed\Company\Persistence\Base\SpyCompany[] $entityCollection
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer[]
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
