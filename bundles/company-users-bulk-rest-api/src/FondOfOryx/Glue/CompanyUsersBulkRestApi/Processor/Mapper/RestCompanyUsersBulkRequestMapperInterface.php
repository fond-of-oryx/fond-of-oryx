<?php

namespace FondOfOryx\Glue\CompanyUsersBulkRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestCompanyUsersBulkRequestAttributesTransfer;

interface RestCompanyUsersBulkRequestMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkRequestAttributesTransfer $restCompanyUsersBulkRequestAttributesTransfer
     * 
     * @return \Generated\Shared\Transfer\RestCompanyUsersBulkRequestAttributesTransfer
     */
    public function fromRestCompanyUsersBulkRequestAttributes(
        RestCompanyUsersBulkRequestAttributesTransfer $restCompanyUsersBulkRequestAttributesTransfer
    ): RestCompanyUsersBulkRequestAttributesTransfer;
}
