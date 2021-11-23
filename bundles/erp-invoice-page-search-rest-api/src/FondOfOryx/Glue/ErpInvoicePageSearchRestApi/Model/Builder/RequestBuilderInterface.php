<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Builder;

use Generated\Shared\Transfer\ErpInvoicePageSearchRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface RequestBuilderInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\ErpInvoicePageSearchRequestTransfer
     */
    public function create(RestRequestInterface $restRequest): ErpInvoicePageSearchRequestTransfer;
}
