<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitAddressSearchRestApi\Persistence\Propel\Mapper;

use FondOfOryx\Zed\CompanyBusinessUnitAddressSearchRestApi\Persistence\CompanyBusinessUnitAddressSearchRestApiRepository;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressTransfer;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress;
use Propel\Runtime\Collection\ObjectCollection;

class CompanyBusinessUnitAddressMapper implements CompanyBusinessUnitAddressMapperInterface
{
    /**
     * @param \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress $entity
     * @param array $ids
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitAddressTransfer
     */
    public function mapEntityToTransfer(SpyCompanyUnitAddress $entity, array $ids = []): CompanyBusinessUnitAddressTransfer
    {
        return (new CompanyBusinessUnitAddressTransfer())
            ->fromArray($entity->toArray(), true)
            ->setIsDefaultShippingAddress(array_key_exists(CompanyBusinessUnitAddressSearchRestApiRepository::KEY_DEFAULT_SHIPPING_IDS, $ids) ? $this->isDefaultId($entity->getIdCompanyUnitAddress(), $ids[CompanyBusinessUnitAddressSearchRestApiRepository::KEY_DEFAULT_SHIPPING_IDS]) : false)
            ->setIsDefaultBillingAddress(array_key_exists(CompanyBusinessUnitAddressSearchRestApiRepository::KEY_DEFAULT_BILLING_IDS, $ids) ? $this->isDefaultId($entity->getIdCompanyUnitAddress(), $ids[CompanyBusinessUnitAddressSearchRestApiRepository::KEY_DEFAULT_BILLING_IDS]) : false)
            ->setCompanyUuid($entity->getCompany()->getUuid());
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection|\Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress[] $entityCollection
     * @param array $ids
     *
     * @return array
     */
    public function mapEntityCollectionToTransfers(ObjectCollection $entityCollection, array $ids = []): array
    {
        $transfers = [];

        foreach ($entityCollection as $entity) {
            $transfers[] = $this->mapEntityToTransfer($entity, $ids);
        }

        return $transfers;
    }

    /**
     * @param int $id
     * @param array $ids
     *
     * @return bool
     */
    protected function isDefaultId(int $id, array $ids): bool
    {
        return in_array($id, $ids);
    }
}
