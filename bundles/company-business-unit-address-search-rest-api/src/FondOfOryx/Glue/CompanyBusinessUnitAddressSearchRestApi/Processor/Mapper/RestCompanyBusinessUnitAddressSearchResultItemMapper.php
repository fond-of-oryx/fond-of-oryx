<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchResultItemTransfer;

class RestCompanyBusinessUnitAddressSearchResultItemMapper implements RestCompanyBusinessUnitAddressSearchResultItemMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressTransfer $companyBusinessUnitAddressListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchResultItemTransfer
     */
    public function fromCompanyBusinessUnitAddress(
        CompanyBusinessUnitAddressTransfer $companyBusinessUnitAddressListTransfer
    ): RestCompanyBusinessUnitAddressSearchResultItemTransfer {
        return (new RestCompanyBusinessUnitAddressSearchResultItemTransfer())->fromArray(
            $companyBusinessUnitAddressListTransfer->toArray(),
            true
        );
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressTransfer[]|\ArrayObject $companyBusinessUnitAddressListTransfers
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchResultItemTransfer[]|\ArrayObject
     */
    public function fromCompanyBusinessUnitAddressCollection(ArrayObject $companyBusinessUnitAddressListTransfers): ArrayObject
    {
        $restCompaniesAttributesTransfers = new ArrayObject();

        foreach ($companyBusinessUnitAddressListTransfers as $companyBusinessUnitAddressListTransfer) {
            $restCompaniesAttributesTransfers->append($this->fromCompanyBusinessUnitAddress($companyBusinessUnitAddressListTransfer));
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
