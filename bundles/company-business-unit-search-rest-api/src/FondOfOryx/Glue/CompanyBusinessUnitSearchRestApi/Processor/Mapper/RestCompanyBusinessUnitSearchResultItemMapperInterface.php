<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitSearchResultItemTransfer;

interface RestCompanyBusinessUnitSearchResultItemMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitSearchResultItemTransfer
     */
    public function fromCompanyBusinessUnit(CompanyBusinessUnitTransfer $companyBusinessUnitListTransfer): RestCompanyBusinessUnitSearchResultItemTransfer;

    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\CompanyBusinessUnitTransfer> $companyBusinessUnitListTransfers
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\RestCompanyBusinessUnitSearchResultItemTransfer>
     */
    public function fromCompanyBusinessUnitCollection(ArrayObject $companyBusinessUnitListTransfers): ArrayObject;

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\RestCompanyBusinessUnitSearchResultItemTransfer>
     */
    public function fromCompanyBusinessUnitList(CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer): ArrayObject;
}
