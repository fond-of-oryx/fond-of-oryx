<?php

namespace FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Reader;

use FondOfOryx\Client\SplittableTotalsRestApi\SplittableTotalsRestApiClientInterface;
use FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Expander\RestSplittableTotalsRequestExpanderInterface;
use FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Mapper\RestSplittableTotalsRequestMapperInterface;
use Generated\Shared\Transfer\RestSplittableTotalsRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RestSplittableTotalsReader implements RestSplittableTotalsReaderInterface
{
    /**
     * @var \FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Mapper\RestSplittableTotalsRequestMapperInterface
     */
    protected $restSplittableTotalsRequestMapper;

    /**
     * @var \FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Expander\RestSplittableTotalsRequestExpanderInterface
     */
    protected $restSplittableTotalsRequestExpander;

    /**
     * @var \FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected $restResponseBuilder;

    /**
     * @var \FondOfOryx\Client\SplittableTotalsRestApi\SplittableTotalsRestApiClientInterface
     */
    protected $client;

    /**
     * @param \FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Mapper\RestSplittableTotalsRequestMapperInterface $restSplittableTotalsRequestMapper
     * @param \FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Expander\RestSplittableTotalsRequestExpanderInterface $restSplittableTotalsRequestExpander
     * @param \FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Builder\RestResponseBuilderInterface $restResponseBuilder
     * @param \FondOfOryx\Client\SplittableTotalsRestApi\SplittableTotalsRestApiClientInterface $client
     */
    public function __construct(
        RestSplittableTotalsRequestMapperInterface $restSplittableTotalsRequestMapper,
        RestSplittableTotalsRequestExpanderInterface $restSplittableTotalsRequestExpander,
        RestResponseBuilderInterface $restResponseBuilder,
        SplittableTotalsRestApiClientInterface $client
    ) {
        $this->restSplittableTotalsRequestMapper = $restSplittableTotalsRequestMapper;
        $this->restSplittableTotalsRequestExpander = $restSplittableTotalsRequestExpander;
        $this->restResponseBuilder = $restResponseBuilder;
        $this->client = $client;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function get(
        RestRequestInterface $restRequest,
        RestSplittableTotalsRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
    ): RestResponseInterface {
        $restSplittableTotalsRequestTransfer = $this->restSplittableTotalsRequestMapper
            ->fromRestSplittableTotalsRequestAttributes($restCheckoutRequestAttributesTransfer);

        $restSplittableTotalsRequestTransfer = $this->restSplittableTotalsRequestExpander
            ->expand($restSplittableTotalsRequestTransfer, $restRequest);

        $restSplittableTotalsResponseTransfer = $this->client
            ->getSplittableTotals($restSplittableTotalsRequestTransfer);

        $splittableTotalsTransfer = $restSplittableTotalsResponseTransfer->getSplittableTotals();

        if ($splittableTotalsTransfer === null || !$restSplittableTotalsResponseTransfer->getIsSuccessful()) {
            return $this->restResponseBuilder->createNotFoundErrorRestResponse();
        }

        return $this->restResponseBuilder->createRestResponse($splittableTotalsTransfer);
    }
}
