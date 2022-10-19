<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper;

use ArrayObject;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Expander\FilterFieldsExpanderInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class FilterFieldsMapper implements FilterFieldsMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Expander\FilterFieldsExpanderInterface
     */
    protected $filterFieldsExpander;

    /**
     * @param \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Expander\FilterFieldsExpanderInterface $filterFieldsExpander
     */
    public function __construct(
        FilterFieldsExpanderInterface $filterFieldsExpander
    ) {
        $this->filterFieldsExpander = $filterFieldsExpander;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer>
     */
    public function fromRestRequest(RestRequestInterface $restRequest): ArrayObject
    {
        $filterFieldTransfers = new ArrayObject();

        return $this->filterFieldsExpander->expand($restRequest, $filterFieldTransfers);
    }
}
