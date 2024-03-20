<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter;

use ArrayObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface RequestParameterFilterInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \ArrayObject|null $filterFieldTransfers
     *
     * @return \ArrayObject
     */
    public function getRequestParameter(RestRequestInterface $restRequest, ?ArrayObject $filterFieldTransfers = null): ArrayObject;
}
