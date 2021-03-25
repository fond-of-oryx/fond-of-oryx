<?php

namespace FondOfOryx\Zed\ReturnLabel\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress;

class ReturnLabelCompanyUnitAddressMapper implements ReturnLabelCompanyUnitAddressMapperInterface
{
    /**
     * @param \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress $companyUnitAddressEntity
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    public function mapCompanyUnitAddressEntityToCompanyUnitAddressTransfer(
        SpyCompanyUnitAddress $companyUnitAddressEntity,
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): CompanyUnitAddressTransfer {
        $companyUnitAddressTransfer = $companyUnitAddressTransfer->fromArray(
            $companyUnitAddressEntity->toArray(),
            true
        );

        $companyUnitAddressTransfer->setIso2Code($companyUnitAddressEntity->getCountry()->getIso2Code());

        return $companyUnitAddressTransfer;
    }
}
