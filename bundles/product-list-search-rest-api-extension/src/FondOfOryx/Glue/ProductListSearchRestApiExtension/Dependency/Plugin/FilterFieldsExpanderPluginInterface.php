<?php

namespace FondOfOryx\Glue\ProductListSearchRestApiExtension\Dependency\Plugin;

use ArrayObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface FilterFieldsExpanderPluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer>
     */
    public function expand(
        RestRequestInterface $restRequest,
        ArrayObject $filterFieldTransfers
    ): ArrayObject;
}
