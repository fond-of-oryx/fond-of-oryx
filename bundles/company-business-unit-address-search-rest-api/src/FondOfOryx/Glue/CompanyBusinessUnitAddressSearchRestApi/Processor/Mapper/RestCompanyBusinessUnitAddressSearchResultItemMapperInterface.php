<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchResultItemTransfer;

interface RestCompanyBusinessUnitAddressSearchResultItemMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressTransfer $companyBusinessUnitAddressListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchResultItemTransfer
     */
    public function fromCompanyBusinessUnitAddress(
        CompanyBusinessUnitAddressTransfer $companyBusinessUnitAddressListTransfer
    ): RestCompanyBusinessUnitAddressSearchResultItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressTransfer[]|\ArrayObject $companyBusinessUnitAddressListTransfers
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchResultItemTransfer[]|\ArrayObject
     */
    public function fromCompanyBusinessUnitAddressCollection(ArrayObject $companyBusinessUnitAddressListTransfers): ArrayObject;

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchResultItemTransfer[]|\ArrayObject
     */
    public function fromCompanyBusinessUnitAddressList(CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer): ArrayObject;
}
