<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\CompanySearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use FondOfOryx\Shared\CompanySearchRestApi\CompanySearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class AllFilterFieldMapper implements FilterFieldMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Filter\RequestParameterFilterInterface
     */
    protected RequestParameterFilterInterface $requestParameterFilter;

    /**
     * @param \FondOfOryx\Glue\CompanySearchRestApi\Processor\Filter\RequestParameterFilterInterface $requestParameterFilter
     */
    public function __construct(RequestParameterFilterInterface $requestParameterFilter)
    {
        $this->requestParameterFilter = $requestParameterFilter;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\FilterFieldTransfer|null
     */
    public function fromRestRequest(RestRequestInterface $restRequest): ?FilterFieldTransfer
    {
        $parameterValue = $this->requestParameterFilter->getRequestParameter($restRequest, 'q');

        if ($parameterValue === null || $parameterValue === '') {
            return null;
        }

        return (new FilterFieldTransfer())->setType(CompanySearchRestApiConstants::FILTER_FIELD_TYPE_ALL)
            ->setValue($parameterValue);
    }
}
