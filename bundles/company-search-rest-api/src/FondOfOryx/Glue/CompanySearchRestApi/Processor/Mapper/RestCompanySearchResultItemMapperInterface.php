<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\CompanyListTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompanySearchResultItemTransfer;

interface RestCompanySearchResultItemMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanySearchResultItemTransfer
     */
    public function fromCompany(CompanyTransfer $companyTransfer): RestCompanySearchResultItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer[]|\ArrayObject $companyTransfers
     *
     * @return \Generated\Shared\Transfer\RestCompanySearchResultItemTransfer[]|\ArrayObject
     */
    public function fromCompanies(ArrayObject $companyTransfers): ArrayObject;

    /**
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanySearchResultItemTransfer[]|\ArrayObject
     */
    public function fromCompanyList(CompanyListTransfer $companyListTransfer): ArrayObject;
}
