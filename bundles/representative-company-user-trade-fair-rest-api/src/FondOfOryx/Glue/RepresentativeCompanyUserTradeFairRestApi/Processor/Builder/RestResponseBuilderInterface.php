<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Builder;

use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface RestResponseBuilderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildRepresentativeCompanyUserTradeFairRestResponse(
        RestRepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
    ): RestResponseInterface;

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer $representativeCompanyUserTradeFairTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildRepresentativeCompanyUserTradeFairCollectionRestResponse(
        RestRepresentativeCompanyUserTradeFairResponseTransfer $representativeCompanyUserTradeFairTransfer
    ): RestResponseInterface;

    /**
     * @param string $error
     * @param int $code
     * @param int $status
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createRestErrorResponse(string $error, int $code, int $status = 0): RestResponseInterface;
}
