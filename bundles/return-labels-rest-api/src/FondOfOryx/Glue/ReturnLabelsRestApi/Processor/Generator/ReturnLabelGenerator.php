<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Generator;

use FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiClientInterface;
use FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Expander\RestReturnLabelRequestExpanderInterface;
use FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Mapper\RestReturnLabelRequestMapperInterface;
use Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class ReturnLabelGenerator implements ReturnLabelGeneratorInterface
{
    /**
     * @var \FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Mapper\RestReturnLabelRequestMapperInterface
     */
    protected $restReturnLabelRequestMapper;

    /**
     * @var \FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Expander\RestReturnLabelRequestExpanderInterface
     */
    protected $restReturnLabelRequestExpander;

    /**
     * @var \FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected $restResponseBuilder;

    /**
     * @var \FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiClientInterface
     */
    protected $client;

    /**
     * @param \FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Mapper\RestReturnLabelRequestMapperInterface $restReturnLabelRequestMapper
     * @param \FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Expander\RestReturnLabelRequestExpanderInterface $restReturnLabelRequestExpander
     * @param \FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Builder\RestResponseBuilderInterface $restResponseBuilder
     * @param \FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiClientInterface $client
     */
    public function __construct(
        RestReturnLabelRequestMapperInterface $restReturnLabelRequestMapper,
        RestReturnLabelRequestExpanderInterface $restReturnLabelRequestExpander,
        RestResponseBuilderInterface $restResponseBuilder,
        ReturnLabelsRestApiClientInterface $client
    ) {
        $this->restReturnLabelRequestMapper = $restReturnLabelRequestMapper;
        $this->restReturnLabelRequestExpander = $restReturnLabelRequestExpander;
        $this->restResponseBuilder = $restResponseBuilder;
        $this->client = $client;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer $restReturnLabelRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function generate(
        RestRequestInterface $restRequest,
        RestReturnLabelRequestAttributesTransfer $restReturnLabelRequestAttributesTransfer
    ): RestResponseInterface {
        $restReturnLabelTransfer = $this->restReturnLabelRequestMapper
            ->fromRestReturnLabelRequestAttributes($restReturnLabelRequestAttributesTransfer);

        $restReturnLabelRequestTransfer = $this->restReturnLabelRequestExpander
            ->expand($restReturnLabelTransfer, $restRequest);

        $restReturnLabelResponseTransfer = $this->client
            ->generateReturnLabel($restReturnLabelRequestTransfer);

        $returnLabelTransfer = $restReturnLabelResponseTransfer->getReturnLabel();

        if ($returnLabelTransfer === null || !$restReturnLabelResponseTransfer->getIsSuccessful()) {
            return $this->restResponseBuilder->createNotGeneratedRestResponse();
        }

        return $this->restResponseBuilder->createRestResponse($returnLabelTransfer);
    }
}
