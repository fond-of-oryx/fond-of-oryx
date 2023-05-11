<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Filter;

use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface RequestParameterFilterInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param string $parameterName
     *
     * @return string|null
     */
    public function getRequestParameter(RestRequestInterface $restRequest, string $parameterName): ?string;
}
