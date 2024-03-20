<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter;

use ArrayObject;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Expander\FilterExpanderInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RequestParameterFilter implements RequestParameterFilterInterface
{
    protected FilterExpanderInterface $expander;

    /**
     * @param \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Expander\FilterExpanderInterface $expander
     */
    public function __construct(FilterExpanderInterface $expander)
    {
        $this->expander = $expander;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \ArrayObject|null $filterFieldTransfers
     *
     * @return \ArrayObject
     */
    public function getRequestParameter(RestRequestInterface $restRequest, ?ArrayObject $filterFieldTransfers = null): ArrayObject
    {
        if ($filterFieldTransfers === null) {
            $filterFieldTransfers = new ArrayObject();
        }

        return $this->expander->expand($restRequest, $filterFieldTransfers);
    }
}
