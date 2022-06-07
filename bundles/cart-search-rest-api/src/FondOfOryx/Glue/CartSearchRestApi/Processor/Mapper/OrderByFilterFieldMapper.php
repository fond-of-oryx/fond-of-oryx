<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

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
     * @param \FondOfOryx\Glue\CartSearchRestApi\Processor\Filter\RequestParameterFilterInterface $requestParameterFilter
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
        $parameterValue = $this->requestParameterFilter->getRequestParameter($restRequest, 'sort');

        if ($parameterValue === null || preg_match(static::PATTERN_PARAMETER_VALUE, $parameterValue) !== 1) {
            return null;
        }

        return (new FilterFieldTransfer())->setType('orderBy')
            ->setValue(preg_replace(static::PATTERN_PARAMETER_VALUE, '$1::$3', $parameterValue));
    }
}
