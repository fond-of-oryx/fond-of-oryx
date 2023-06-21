<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\OrderBudgetListTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface OrderBudgetListMapperInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\OrderBudgetListTransfer
     */
    public function fromRestRequest(RestRequestInterface $restRequest): OrderBudgetListTransfer;
}
