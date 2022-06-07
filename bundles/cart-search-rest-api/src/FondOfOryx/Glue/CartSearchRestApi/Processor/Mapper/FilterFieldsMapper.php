<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use ArrayObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class FilterFieldsMapper implements FilterFieldsMapperInterface
{
     /**
      * @var array<\FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\FilterFieldMapperInterface>
      */
    protected $filterFieldMappers;

    /**
     * @param array<\FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\FilterFieldMapperInterface> $filterFieldMappers
     */
    public function __construct(array $filterFieldMappers)
    {
        $this->filterFieldMappers = $filterFieldMappers;
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

        return $filterFieldTransfers;
    }
}
