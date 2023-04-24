<?php

namespace FondOfOryx\Glue\RepresentationOfSalesRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestRepresentationOfSalesAttributesTransfer;
use Generated\Shared\Transfer\RestRepresentationOfSalesRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface RepresentationMapperInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestRepresentationOfSalesAttributesTransfer|null $attributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentationOfSalesRequestTransfer
     */
    public function createRequest(RestRequestInterface $restRequest, RestRepresentationOfSalesAttributesTransfer $attributesTransfer = null): RestRepresentationOfSalesRequestTransfer;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestRepresentationOfSalesAttributesTransfer
     */
    public function createAttributesFromRequest(RestRequestInterface $restRequest): RestRepresentationOfSalesAttributesTransfer;
}
