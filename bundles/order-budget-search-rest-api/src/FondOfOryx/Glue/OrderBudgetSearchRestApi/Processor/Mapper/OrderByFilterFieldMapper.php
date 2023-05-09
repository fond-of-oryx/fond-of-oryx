<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use FondOfOryx\Shared\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class OrderByFilterFieldMapper implements FilterFieldMapperInterface
{
    /**
     * @var string
     */
    protected const PATTERN_PARAMETER_VALUE = '/^([a-z0-9]+(_[a-z0-9]+)*)_(asc|desc)/';

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Filter\RequestParameterFilterInterface
     */
    protected RequestParameterFilterInterface $requestParameterFilter;

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig
     */
    protected OrderBudgetSearchRestApiConfig $config;

    /**
     * @param \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Filter\RequestParameterFilterInterface $requestParameterFilter
     * @param \FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig $config
     */
    public function __construct(
        RequestParameterFilterInterface $requestParameterFilter,
        OrderBudgetSearchRestApiConfig $config
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

        return (new FilterFieldTransfer())->setType(OrderBudgetSearchRestApiConstants::FILTER_FIELD_TYPE_ORDER_BY)
            ->setValue(sprintf(
                '%s%s%s',
                $sortField,
                OrderBudgetSearchRestApiConstants::DELIMITER_ORDER_BY,
                $sortDirection,
            ));
    }
}
