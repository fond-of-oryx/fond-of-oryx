<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Builder;

use FondOfOryx\Glue\ErpOrderPageSearchRestApi\ErpOrderPageSearchRestApiConfig;
use Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface RequestBuilderInterface
{
    /**
     * @param  \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface  $restRequest
     *
     * @return \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer
     */
    public function create(RestRequestInterface $restRequest): ErpOrderPageSearchRequestTransfer;
}
