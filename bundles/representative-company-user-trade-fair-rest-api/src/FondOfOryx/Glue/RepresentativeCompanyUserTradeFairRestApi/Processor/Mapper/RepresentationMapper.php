<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer;
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
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer|null $attributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer
     */
    public function createRequest(
        RestRequestInterface $restRequest,
        ?RestRepresentativeCompanyUserTradeFairAttributesTransfer $attributesTransfer = null
    ): RestRepresentativeCompanyUserTradeFairRequestTransfer {
        if ($attributesTransfer === null) {
            $attributesTransfer = $this->createAttributesFromRequest($restRequest);
        }

        return (new RestRepresentativeCompanyUserTradeFairRequestTransfer())
            ->setAttributes($attributesTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer
     */
    public function createAttributesFromRequest(RestRequestInterface $restRequest): RestRepresentativeCompanyUserTradeFairAttributesTransfer
    {
        $data = $restRequest->getAttributesDataFromRequest();
        if ($data === null) {
            $data = [];
        }

        return (new RestRepresentativeCompanyUserTradeFairAttributesTransfer())
            ->fromArray($data, true)
            ->setUuid($this->getUuid($restRequest))
            ->setCustomerReferenceOriginator($this->getOriginatorCustomerUserReference($restRequest));
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
