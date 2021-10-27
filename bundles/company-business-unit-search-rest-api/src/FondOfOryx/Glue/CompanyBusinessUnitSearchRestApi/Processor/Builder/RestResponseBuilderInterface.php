<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Builder;

use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface RestResponseBuilderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
     * @param string $locale
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildCompanyBusinessUnitSearchRestResponse(
        CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer,
        string $locale
    ): RestResponseInterface;

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildUseIsNotSpecifiedRestResponse(): RestResponseInterface;
}
