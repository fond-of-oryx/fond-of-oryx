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
     * @param \ArrayObject<\Generated\Shared\Transfer\CompanyBusinessUnitAddressTransfer> $companyBusinessUnitAddressTransfers
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchResultItemTransfer>
     */
    public function fromCompanyBusinessUnitAddressCollection(ArrayObject $companyBusinessUnitAddressTransfers): ArrayObject;

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchResultItemTransfer>
     */
    public function fromCompanyBusinessUnitAddressList(CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer): ArrayObject;
}
