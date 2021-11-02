<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder;

use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableTotalsMapperInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\SplittableTotalsTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class SplittableTotalsRestResponseBuilder implements SplittableTotalsRestResponseBuilderInterface
{
    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableTotalsMapperInterface
     */
    protected $restSplittableTotalsMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableTotalsMapperInterface $restSplittableTotalsMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        RestSplittableTotalsMapperInterface $restSplittableTotalsMapper,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->restSplittableTotalsMapper = $restSplittableTotalsMapper;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createNotFoundErrorRestResponse(): RestResponseInterface
    {
        $restErrorTransfer = (new RestErrorMessageTransfer())
            ->setCode(SplittableCheckoutRestApiConfig::RESPONSE_CODE_SPLITTABLE_TOTALS_NOT_FOUND)
            ->setStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->setDetail(SplittableCheckoutRestApiConfig::EXCEPTION_MESSAGE_SPLITTABLE_TOTALS_NOT_FOUND);

        return $this->restResourceBuilder->createRestResponse()->addError($restErrorTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\SplittableTotalsTransfer $splittableTotalsTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createRestResponse(
        SplittableTotalsTransfer $splittableTotalsTransfer
    ): RestResponseInterface {
        $restSplittableTotalsTransfer = $this->restSplittableTotalsMapper
            ->fromSplittableTotals($splittableTotalsTransfer);

        $restResource = $this->restResourceBuilder->createRestResource(
            SplittableCheckoutRestApiConfig::RESOURCE_SPLITTABLE_TOTALS,
            null,
            $restSplittableTotalsTransfer,
        );

        $restResource->setPayload($restSplittableTotalsTransfer);

        return $this->restResourceBuilder
            ->createRestResponse()
            ->addResource($restResource)
            ->setStatus(Response::HTTP_CREATED);
    }
}
