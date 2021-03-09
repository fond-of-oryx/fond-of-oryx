<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\SplittableCheckout;

use FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiClientInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\RequestAttributesExpander\SplittableCheckoutRequestAttributesExpanderInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\RestResponseBuilder\SplittableCheckoutRestResponseBuilderInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Validator\SplittableCheckoutRequestValidatorInterface;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class SplittableCheckoutProcessor implements SplittableCheckoutProcessorInterface
{
    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\RestResponseBuilder\SplittableCheckoutRestResponseBuilderInterface
     */
    protected $splittableCheckoutRestResponseBuilder;

    /**
     * @var \FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiClientInterface
     */
    protected $splittableCheckoutRestApiClient;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\RequestAttributesExpander\SplittableCheckoutRequestAttributesExpanderInterface
     */
    protected $splittableCheckoutRequestAttributesExpander;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Validator\SplittableCheckoutRequestValidatorInterface
     */
    protected $splittableCheckoutRequestValidator;

    /**
     * @param \FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiClientInterface $splittableCheckoutRestApiClient
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Validator\SplittableCheckoutRequestValidatorInterface $splittableCheckoutRequestValidator
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\RequestAttributesExpander\SplittableCheckoutRequestAttributesExpanderInterface $splittableCheckoutRequestAttributesExpander
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\RestResponseBuilder\SplittableCheckoutRestResponseBuilderInterface $splittableCheckoutRestResponseBuilder
     */
    public function __construct(
        SplittableCheckoutRestApiClientInterface $splittableCheckoutRestApiClient,
        SplittableCheckoutRequestValidatorInterface $splittableCheckoutRequestValidator,
        SplittableCheckoutRequestAttributesExpanderInterface $splittableCheckoutRequestAttributesExpander,
        SplittableCheckoutRestResponseBuilderInterface $splittableCheckoutRestResponseBuilder
    ) {
        $this->splittableCheckoutRequestAttributesExpander = $splittableCheckoutRequestAttributesExpander;
        $this->splittableCheckoutRequestValidator = $splittableCheckoutRequestValidator;
        $this->splittableCheckoutRestApiClient = $splittableCheckoutRestApiClient;
        $this->splittableCheckoutRestResponseBuilder = $splittableCheckoutRestResponseBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function placeOrder(
        RestRequestInterface $restRequest,
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
    ): RestResponseInterface {
        $restErrorCollectionTransfer = $this->splittableCheckoutRequestValidator
            ->validateSplittableCheckoutRequest($restRequest, $restSplittableCheckoutRequestAttributesTransfer);

        if ($restErrorCollectionTransfer->getRestErrors()->count()) {
            return $this->createValidationErrorResponse($restErrorCollectionTransfer);
        }

        $restSplittableCheckoutRequestAttributesTransfer = $this->splittableCheckoutRequestAttributesExpander
            ->expandSplittableCheckoutRequestAttributes($restRequest, $restSplittableCheckoutRequestAttributesTransfer);

        $restSplittableCheckoutResponseTransfer = $this->splittableCheckoutRestApiClient
            ->placeOrder($restSplittableCheckoutRequestAttributesTransfer);

        if ($restSplittableCheckoutResponseTransfer->getIsSuccess() === false) {
            return $this->splittableCheckoutRestResponseBuilder
                ->createPlaceOrderFailedErrorResponse(
                    $restSplittableCheckoutResponseTransfer->getErrors(),
                    $restRequest->getMetadata()->getLocale()
                );
        }

        return $this->splittableCheckoutRestResponseBuilder
            ->createSplittableCheckoutRestResponse(
                $restSplittableCheckoutResponseTransfer
            );
    }
}
