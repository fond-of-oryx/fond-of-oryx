<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyListTransfer;
use Generated\Shared\Transfer\RestCompanySearchAttributesTransfer;

interface RestCompanySearchAttributesMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanySearchAttributesTransfer
     */
    public function fromCompanyList(CompanyListTransfer $companyListTransfer): RestCompanySearchAttributesTransfer;
}
