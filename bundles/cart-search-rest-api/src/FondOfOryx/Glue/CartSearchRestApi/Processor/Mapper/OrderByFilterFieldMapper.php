<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class OrderByFilterFieldMapper implements FilterFieldMapperInterface
{
     /**
      * @var string
      */
    protected const PATTERN_PARAMETER_VALUE = '/^([a-z0-9]+(_[a-z0-9]+)*)_(asc|desc)/';

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Filter\RequestParameterFilterInterface
     */
    protected $requestParameterFilter;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Glue\CartSearchRestApi\Processor\Filter\RequestParameterFilterInterface $requestParameterFilter
     * @param \FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig $config
     */
    public function __construct(
        RequestParameterFilterInterface $requestParameterFilter,
        CartSearchRestApiConfig $config
    ) {
        $this->requestParameterFilter = $requestParameterFilter;
        $this->config = $config;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\FilterFieldTransfer|null
     */
    public function fromRestRequest(RestRequestInterface $restRequest): ?FilterFieldTransfer
    {
        $parameterValue = $this->requestParameterFilter->getRequestParameter($restRequest, 'sort');

        if ($parameterValue === null || preg_match(static::PATTERN_PARAMETER_VALUE, $parameterValue) !== 1) {
            return null;
        }

        $sortFields = $this->config->getSortFields();
        $sortField = preg_replace(static::PATTERN_PARAMETER_VALUE, '$1', $parameterValue);

        if (!in_array($sortField, $sortFields, true)) {
            return null;
        }

        $sortDirection = preg_replace(static::PATTERN_PARAMETER_VALUE, '$3', $parameterValue);

        return (new FilterFieldTransfer())->setType('orderBy')
            ->setValue(sprintf('%s::%s', $sortField, $sortDirection));
    }
}
