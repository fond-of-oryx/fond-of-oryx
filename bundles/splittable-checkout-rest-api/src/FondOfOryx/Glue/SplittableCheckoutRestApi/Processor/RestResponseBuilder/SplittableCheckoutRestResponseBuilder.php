<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\RestResponseBuilder;

use FondOfOryx\Glue\SplittableCheckoutRestApi\Mapper\RestSplittableCheckoutErrorMapperInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

class SplittableCheckoutRestResponseBuilder implements SplittableCheckoutRestResponseBuilderInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Mapper\RestSplittableCheckoutErrorMapperInterface
     */
    protected $restSplittableCheckoutErrorMapper;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\Mapper\RestSplittableCheckoutErrorMapperInterface $restSplittableCheckoutErrorMapper
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        RestSplittableCheckoutErrorMapperInterface $restSplittableCheckoutErrorMapper
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->restSplittableCheckoutErrorMapper = $restSplittableCheckoutErrorMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer $restSplittableCheckoutResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createSplittableCheckoutRestResponse(
        RestSplittableCheckoutResponseTransfer $restSplittableCheckoutResponseTransfer
    ): RestResponseInterface {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        return $restResponse->addResource(
            $this->createSplittableCheckoutResource($restSplittableCheckoutResponseTransfer)
        );
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer $restSplittableCheckoutResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    public function createSplittableCheckoutResource(
        RestSplittableCheckoutResponseTransfer $restSplittableCheckoutResponseTransfer
    ): RestResourceInterface {
        return $this->restResourceBuilder->createRestResource(
            SplittableCheckoutRestApiConfig::RESOURCE_SPLITTABLE_CHECKOUT,
            null,
            $restSplittableCheckoutResponseTransfer
        );
    }

    /**
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\RestResponseBuilder\ArrayObject $errors
     * @param string $locale
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createPlaceOrderFailedErrorResponse(
        ArrayObject $errors,
        string $locale
    ): RestResponseInterface {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        foreach ($errors as $error) {
            $restResponse->addError(
                $this->restSplittableCheckoutErrorMapper
                    ->mapLocalizedRestSplittableCheckoutErrorTransferToRestErrorTransfer(
                        $error,
                        new RestErrorMessageTransfer(),
                        $locale
                    )
            );
        }

        return $restResponse;
    }
}
