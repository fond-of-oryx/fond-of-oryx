<?php

namespace FondOfOryx\Glue\PriceListsRestApiExtension\Dependency\Plugin;

use Generated\Shared\Transfer\PriceListListTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface PriceListListExpanderPluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\PriceListListTransfer $priceListListTransfer
     *
     * @return \Generated\Shared\Transfer\PriceListListTransfer
     */
    public function expand(
        RestRequestInterface $restRequest,
        PriceListListTransfer $priceListListTransfer
    ): PriceListListTransfer;
}
