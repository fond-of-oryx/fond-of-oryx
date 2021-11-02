<?php

namespace FondOfOryx\Zed\CompanySearchRestApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CompanyTransfer;
use Orm\Zed\Company\Persistence\Base\SpyCompany;
use Propel\Runtime\Collection\ObjectCollection;

interface CompanyMapperInterface
{
    /**
     * @param \Orm\Zed\Company\Persistence\Base\SpyCompany $entity
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function mapEntityToTransfer(SpyCompany $entity): CompanyTransfer;

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection|\Orm\Zed\Company\Persistence\Base\SpyCompany[] $entityCollection
     *
     * @return array<\Generated\Shared\Transfer\CompanyTransfer>
     */
    public function mapEntityCollectionToTransfers(ObjectCollection $entityCollection): array;
}
