<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Builder;

use Generated\Shared\Transfer\CompanyListTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface RestResponseBuilderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     * @param string $locale
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildCompanySearchRestResponse(
        CompanyListTransfer $companyListTransfer,
        string $locale
    ): RestResponseInterface;

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildUseIsNotSpecifiedRestResponse(): RestResponseInterface;
}
