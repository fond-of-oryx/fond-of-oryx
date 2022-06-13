<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use ArrayObject;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Expander\FilterFieldsExpanderInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class FilterFieldsMapper implements FilterFieldsMapperInterface
{
     /**
      * @var array<\FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\FilterFieldMapperInterface>
      */
    protected $filterFieldMappers;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Expander\FilterFieldsExpanderInterface
     */
    protected $filterFieldsExpander;

    /**
     * @param array<\FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\FilterFieldMapperInterface> $filterFieldMappers
     * @param \FondOfOryx\Glue\CartSearchRestApi\Processor\Expander\FilterFieldsExpanderInterface $filterFieldsExpander
     */
    public function __construct(
        array $filterFieldMappers,
        FilterFieldsExpanderInterface $filterFieldsExpander
    ) {
        $this->filterFieldMappers = $filterFieldMappers;
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

        foreach ($this->filterFieldMappers as $filterFieldMapper) {
            $filterFieldTransfer = $filterFieldMapper->fromRestRequest($restRequest);

            if ($filterFieldTransfer === null) {
                continue;
            }

            $filterFieldTransfers->append($filterFieldTransfer);
        }

        return $this->filterFieldsExpander->expand($restRequest, $filterFieldTransfers);
    }
}
