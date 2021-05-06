<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Builder;

use FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Mapper\RestReturnLabelMapperInterface;
use FondOfOryx\Glue\ReturnLabelsRestApi\ReturnLabelsRestApiConfig;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\ReturnLabelTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilder implements RestResponseBuilderInterface
{
    /**
     * @var \FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Mapper\RestReturnLabelMapperInterface
     */
    protected $restReturnLabelMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Mapper\RestReturnLabelMapperInterface $restReturnLabelMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        RestReturnLabelMapperInterface $restReturnLabelMapper,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->restReturnLabelMapper = $restReturnLabelMapper;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @inheritDoc
     */
    public function createNotGeneratedRestResponse(): RestResponseInterface
    {
        $restErrorTransfer = (new RestErrorMessageTransfer())
            ->setCode(ReturnLabelsRestApiConfig::RESPONSE_CODE_NOT_GENERATED)
            ->setStatus(Response::HTTP_NOT_FOUND)
            ->setDetail(ReturnLabelsRestApiConfig::RESPONSE_DETAIL_NOT_GENERATED);

        return $this->restResourceBuilder->createRestResponse()->addError($restErrorTransfer);
    }

    /**
     * @inheritDoc
     */
    public function createRestResponse(ReturnLabelTransfer $returnLabelTransfer): RestResponseInterface
    {
        $restReturnLabelTransfer = $this->restReturnLabelMapper
            ->fromReturnLabel($returnLabelTransfer);

        $restResource = $this->restResourceBuilder->createRestResource(
            ReturnLabelsRestApiConfig::RESOURCE_RETURN_LABELS,
            null,
            $restReturnLabelTransfer
        );

        $restResource->setPayload($restReturnLabelTransfer);

        return $this->restResourceBuilder
            ->createRestResponse()
            ->addResource($restResource)
            ->setStatus(Response::HTTP_OK);
    }
}
