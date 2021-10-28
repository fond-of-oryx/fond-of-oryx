<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitAddressSearchRestApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CompanyBusinessUnitAddressTransfer;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress;
use Propel\Runtime\Collection\ObjectCollection;

interface CompanyBusinessUnitAddressMapperInterface
{
    /**
     * @param \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress $entity
     * @param array $ids
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitAddressTransfer
     */
    public function mapEntityToTransfer(SpyCompanyUnitAddress $entity, array $ids = []): CompanyBusinessUnitAddressTransfer;

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection|\Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress[] $entityCollection
     * @param array $ids
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return array
     */
    public function mapEntityCollectionToTransfers(ObjectCollection $entityCollection, array $ids = []): array;
}
