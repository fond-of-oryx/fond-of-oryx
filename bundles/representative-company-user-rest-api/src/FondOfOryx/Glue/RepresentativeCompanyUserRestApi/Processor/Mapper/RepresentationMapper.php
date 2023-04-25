<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RepresentationMapper implements RepresentationMapperInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer|null $attributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer
     */
    public function createRequest(
        RestRequestInterface $restRequest,
        ?RestRepresentativeCompanyUserAttributesTransfer $attributesTransfer = null
    ): RestRepresentativeCompanyUserRequestTransfer {
        if ($attributesTransfer === null) {
            $attributesTransfer = $this->createAttributesFromRequest($restRequest);
        }

        return (new RestRepresentativeCompanyUserRequestTransfer())
            ->setAttributes($attributesTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer
     */
    public function createAttributesFromRequest(RestRequestInterface $restRequest): RestRepresentativeCompanyUserAttributesTransfer
    {
        return (new RestRepresentativeCompanyUserAttributesTransfer())
            ->fromArray($restRequest->getAttributesDataFromRequest(), true)
            ->setReferenceOriginator($this->getOriginatorCustomerUserReference($restRequest));
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return string|null
     */
    protected function getOriginatorCustomerUserReference(RestRequestInterface $restRequest): ?string
    {
        return $restRequest->getRestUser()->getNaturalIdentifier();
    }
}
