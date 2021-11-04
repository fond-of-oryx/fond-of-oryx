<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter;

use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RequestParameterFilter implements RequestParameterFilterInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param string $parameterName
     *
     * @return string|null
     */
    public function getRequestParameter(RestRequestInterface $restRequest, string $parameterName): ?string
    {
        $requestParameter = $restRequest->getHttpRequest()->query->get($parameterName);

        if ($requestParameter === null) {
            return null;
        }

        return (string)$requestParameter;
    }
}
