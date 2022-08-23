<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\SplittableCheckout;

use FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiClientInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder\SplittableCheckoutRestResponseBuilderInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Expander\RestSplittableCheckoutRequestExpanderInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutRequestMapperInterface;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class SplittableCheckoutProcessor implements SplittableCheckoutProcessorInterface
{
    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutRequestMapperInterface
     */
    protected $restSplittableCheckoutRequestMapper;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Expander\RestSplittableCheckoutRequestExpanderInterface
     */
    protected $restSplittableCheckoutRequestExpander;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder\SplittableCheckoutRestResponseBuilderInterface
     */
    protected $restResponseBuilder;

    /**
     * @var \FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiClientInterface
     */
    protected $client;

    /**
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutRequestMapperInterface $restSplittableCheckoutRequestMapper
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Expander\RestSplittableCheckoutRequestExpanderInterface $restSplittableCheckoutRequestExpander
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder\SplittableCheckoutRestResponseBuilderInterface $restResponseBuilder
     * @param \FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiClientInterface $client
     */
    public function __construct(
        RestSplittableCheckoutRequestMapperInterface $restSplittableCheckoutRequestMapper,
        RestSplittableCheckoutRequestExpanderInterface $restSplittableCheckoutRequestExpander,
        SplittableCheckoutRestResponseBuilderInterface $restResponseBuilder,
        SplittableCheckoutRestApiClientInterface $client
    ) {
        $this->restSplittableCheckoutRequestMapper = $restSplittableCheckoutRequestMapper;
        $this->restSplittableCheckoutRequestExpander = $restSplittableCheckoutRequestExpander;
        $this->restResponseBuilder = $restResponseBuilder;
        $this->client = $client;
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
        $restSplittableCheckoutRequestTransfer = $this->restSplittableCheckoutRequestMapper
            ->fromRestSplittableCheckoutRequestAttributes($restSplittableCheckoutRequestAttributesTransfer);

        $restSplittableCheckoutRequestTransfer = $this->restSplittableCheckoutRequestExpander
            ->expand($restSplittableCheckoutRequestTransfer, $restRequest);

        $restSplittableCheckoutResponseTransfer = $this->client
            ->placeOrder($restSplittableCheckoutRequestTransfer);

        $splittableCheckoutTransfer = $restSplittableCheckoutResponseTransfer->getSplittableCheckout();

        if ($splittableCheckoutTransfer === null || $restSplittableCheckoutResponseTransfer->getIsSuccessful() === false) {
            return $this->restResponseBuilder->createNotPlacedErrorRestResponse(
                $restSplittableCheckoutResponseTransfer->getErrors(),
                $restRequest,
            );
        }

        return $this->restResponseBuilder->createRestResponse($splittableCheckoutTransfer);
    }
}
