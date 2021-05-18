<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\CountryTransfer;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress;

class CompanyUnitAddressMapper implements CompanyUnitAddressMapperInterface
{
    /**
     * @param \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress $entity
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $transfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    public function mapEntityToTransfer(
        SpyCompanyUnitAddress $entity,
        CompanyUnitAddressTransfer $transfer
    ): CompanyUnitAddressTransfer {
        $transfer = $transfer->fromArray($entity->toArray(), true);

        $countryTransfer = (new CountryTransfer())
            ->fromArray($entity->getCountry()->toArray(), true);

        return $transfer->setCountry($countryTransfer->getName())
            ->setIso3Code($countryTransfer->getIso3Code());
    }
}
