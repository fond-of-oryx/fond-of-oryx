<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Builder;

use Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface RequestBuilderInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer
     */
    public function create(RestRequestInterface $restRequest): ErpOrderPageSearchRequestTransfer;
}
