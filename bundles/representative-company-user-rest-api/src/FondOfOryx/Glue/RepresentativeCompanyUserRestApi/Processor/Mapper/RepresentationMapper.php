<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\Request;

class RepresentationMapper implements RepresentationMapperInterface
{
    /**
     * @var array
     */
    protected const UUID_METHODS = [
        Request::METHOD_PATCH,
        Request::METHOD_DELETE,
        Request::METHOD_GET,
    ];

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
        $data = $restRequest->getAttributesDataFromRequest();
        if ($data === null) {
            $data = [];
        }

        return (new RestRepresentativeCompanyUserAttributesTransfer())
            ->fromArray($data, true)
            ->setUuid($this->getUuid($restRequest))
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

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return string|null
     */
    protected function getUuid(RestRequestInterface $restRequest): ?string
    {
        $meta = $restRequest->getMetadata();
        if (in_array($meta->getMethod(), static::UUID_METHODS, true)) {
            return $restRequest->getResource()->getId();
        }

        return null;
    }
}
