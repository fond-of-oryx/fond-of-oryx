<?php

namespace FondOfOryx\Glue\CompaniesRestApi\Processor\Builder;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface RestResponseBuilderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     * @param string $locale
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildCompanyDeleterRestResponse(
        CompanyTransfer $companyTransfer
    ): RestResponseInterface;
}
