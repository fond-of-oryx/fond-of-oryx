<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchResultItemTransfer;

class RestCompanyBusinessUnitAddressSearchResultItemMapper implements RestCompanyBusinessUnitAddressSearchResultItemMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressTransfer $companyBusinessUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchResultItemTransfer
     */
    public function fromCompanyBusinessUnitAddress(
        CompanyBusinessUnitAddressTransfer $companyBusinessUnitAddressTransfer
    ): RestCompanyBusinessUnitAddressSearchResultItemTransfer {
        return (new RestCompanyBusinessUnitAddressSearchResultItemTransfer())->fromArray(
            $companyBusinessUnitAddressTransfer->toArray(),
            true
        )
            ->setCompanyId($companyBusinessUnitAddressTransfer->getCompanyUuid())
            ->setCompanyBusinessUnitId($companyBusinessUnitAddressTransfer->getCompanyBusinessUnitUuid());
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressTransfer[]|\ArrayObject $companyBusinessUnitAddressTransfers
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchResultItemTransfer[]|\ArrayObject
     */
    public function fromCompanyBusinessUnitAddressCollection(ArrayObject $companyBusinessUnitAddressTransfers): ArrayObject
    {
        $restCompaniesAttributesTransfers = new ArrayObject();

        foreach ($companyBusinessUnitAddressTransfers as $companyBusinessUnitAddressTransfer) {
            $restCompaniesAttributesTransfers->append($this->fromCompanyBusinessUnitAddress($companyBusinessUnitAddressTransfer));
        }

        return $restCompaniesAttributesTransfers;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchResultItemTransfer[]|\ArrayObject
     */
    public function fromCompanyBusinessUnitAddressList(CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer): ArrayObject
    {
        return $this->fromCompanyBusinessUnitAddressCollection($companyBusinessUnitAddressListTransfer->getCompanyBusinessUnitAddresses());
    }
}
