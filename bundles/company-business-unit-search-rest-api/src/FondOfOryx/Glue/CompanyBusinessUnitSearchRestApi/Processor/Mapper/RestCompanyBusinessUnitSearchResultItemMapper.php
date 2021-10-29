<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitSearchResultItemTransfer;

class RestCompanyBusinessUnitSearchResultItemMapper implements RestCompanyBusinessUnitSearchResultItemMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitSearchResultItemTransfer
     */
    public function fromCompanyBusinessUnit(CompanyBusinessUnitTransfer $companyBusinessUnitListTransfer): RestCompanyBusinessUnitSearchResultItemTransfer
    {
        return (new RestCompanyBusinessUnitSearchResultItemTransfer())->fromArray(
            $companyBusinessUnitListTransfer->toArray(),
            true
        )->setCompanyId($companyBusinessUnitListTransfer->getCompanyUuid());
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer[]|\ArrayObject $companyBusinessUnitListTransfers
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitSearchResultItemTransfer[]|\ArrayObject
     */
    public function fromCompanyBusinessUnitCollection(ArrayObject $companyBusinessUnitListTransfers): ArrayObject
    {
        $restCompaniesAttributesTransfers = new ArrayObject();

        foreach ($companyBusinessUnitListTransfers as $companyBusinessUnitListTransfer) {
            $restCompaniesAttributesTransfers->append($this->fromCompanyBusinessUnit($companyBusinessUnitListTransfer));
        }

        return $restCompaniesAttributesTransfers;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitSearchResultItemTransfer[]|\ArrayObject
     */
    public function fromCompanyBusinessUnitList(CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer): ArrayObject
    {
        return $this->fromCompanyBusinessUnitCollection($companyBusinessUnitListTransfer->getCompanyBusinessUnits());
    }
}
