<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Reader;

use FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiClientInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder\SplittableTotalsRestResponseBuilderInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Expander\RestSplittableCheckoutRequestExpanderInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutRequestMapperInterface;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class SplittableTotalsReader implements SplittableTotalsReaderInterface
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
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder\SplittableTotalsRestResponseBuilderInterface
     */
    protected $restResponseBuilder;

    /**
     * @var \FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiClientInterface
     */
    protected $client;

    /**
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutRequestMapperInterface $restSplittableCheckoutRequestMapper
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Expander\RestSplittableCheckoutRequestExpanderInterface $restSplittableCheckoutRequestExpander
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder\SplittableTotalsRestResponseBuilderInterface $restResponseBuilder
     * @param \FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiClientInterface $client
     */
    public function __construct(
        RestSplittableCheckoutRequestMapperInterface $restSplittableCheckoutRequestMapper,
        RestSplittableCheckoutRequestExpanderInterface $restSplittableCheckoutRequestExpander,
        SplittableTotalsRestResponseBuilderInterface $restResponseBuilder,
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
    public function get(
        RestRequestInterface $restRequest,
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
    ): RestResponseInterface {
        $restSplittableCheckoutRequestTransfer = $this->restSplittableCheckoutRequestMapper
            ->fromRestSplittableCheckoutRequestAttributes($restSplittableCheckoutRequestAttributesTransfer);

        $restSplittableCheckoutRequestTransfer = $this->restSplittableCheckoutRequestExpander
            ->expand($restSplittableCheckoutRequestTransfer, $restRequest);

        $restSplittableTotalsResponseTransfer = $this->client
            ->getSplittableTotals($restSplittableCheckoutRequestTransfer);

        $splittableTotalsTransfer = $restSplittableTotalsResponseTransfer->getSplittableTotals();

        if ($splittableTotalsTransfer === null || !$restSplittableTotalsResponseTransfer->getIsSuccessful()) {
            return $this->restResponseBuilder->createNotFoundErrorRestResponse();
        }

        return $this->restResponseBuilder->createRestResponse($splittableTotalsTransfer);
    }
}
