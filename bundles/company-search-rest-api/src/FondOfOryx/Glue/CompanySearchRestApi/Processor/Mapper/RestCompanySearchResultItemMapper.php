<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\CompanyListTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompanySearchResultItemTransfer;

class RestCompanySearchResultItemMapper implements RestCompanySearchResultItemMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanySearchResultItemTransfer
     */
    public function fromCompany(CompanyTransfer $companyTransfer): RestCompanySearchResultItemTransfer
    {
        return (new RestCompanySearchResultItemTransfer())->fromArray(
            $companyTransfer->toArray(),
            true
        )->setId($companyTransfer->getUuid());
    }

    /**
     * @param \ArrayObject|\Generated\Shared\Transfer\CompanyTransfer[] $companyTransfers
     *
     * @return \Generated\Shared\Transfer\RestCompanySearchResultItemTransfer[]|\ArrayObject
     */
    public function fromCompanies(ArrayObject $companyTransfers): ArrayObject
    {
        $restCompaniesAttributesTransfers = new ArrayObject();

        foreach ($companyTransfers as $companyTransfer) {
            $restCompaniesAttributesTransfers->append($this->fromCompany($companyTransfer));
        }

        return $restCompaniesAttributesTransfers;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanySearchResultItemTransfer[]|\ArrayObject
     */
    public function fromCompanyList(CompanyListTransfer $companyListTransfer): ArrayObject
    {
        return $this->fromCompanies($companyListTransfer->getCompanies());
    }
}
