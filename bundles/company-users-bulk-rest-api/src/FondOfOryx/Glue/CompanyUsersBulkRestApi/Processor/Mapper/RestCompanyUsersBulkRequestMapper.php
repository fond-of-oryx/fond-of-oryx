<?php

namespace FondOfOryx\Glue\CompanyUsersBulkRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestCompanyUsersBulkRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer;

class RestCompanyUsersBulkRequestMapper implements RestCompanyUsersBulkRequestMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkRequestAttributesTransfer $restCompanyUsersBulkRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyUsersBulkRequestAttributesTransfer
     */
    public function fromRestCompanyUsersBulkRequestAttributes(
        RestCompanyUsersBulkRequestAttributesTransfer $restCompanyUsersBulkRequestAttributesTransfer
    ): RestCompanyUsersBulkRequestTransfer {
        return (new RestCompanyUsersBulkRequestTransfer())
            ->fromArray($restCompanyUsersBulkRequestAttributesTransfer->toArray(), true);
    }
}
