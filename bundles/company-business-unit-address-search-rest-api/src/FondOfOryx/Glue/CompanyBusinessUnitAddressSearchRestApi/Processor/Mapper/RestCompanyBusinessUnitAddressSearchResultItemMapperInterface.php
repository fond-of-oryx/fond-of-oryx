<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchResultItemTransfer;

interface RestCompanyBusinessUnitAddressSearchResultItemMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressTransfer $companyBusinessUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchResultItemTransfer
     */
    public function fromCompanyBusinessUnitAddress(
        CompanyBusinessUnitAddressTransfer $companyBusinessUnitAddressTransfer
    ): RestCompanyBusinessUnitAddressSearchResultItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressTransfer[]|\ArrayObject $companyBusinessUnitAddressTransfers
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchResultItemTransfer[]|\ArrayObject
     */
    public function fromCompanyBusinessUnitAddressCollection(ArrayObject $companyBusinessUnitAddressTransfers): ArrayObject;

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchResultItemTransfer[]|\ArrayObject
     */
    public function fromCompanyBusinessUnitAddressList(CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer): ArrayObject;
}
