<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Expander;

use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface QuoteResourceRelationshipExpanderInterface
{
    /**
     * @param array<\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface> $resources
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return void
     */
    public function expand(array $resources, RestRequestInterface $restRequest): void;
}
