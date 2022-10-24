<?php

namespace FondOfOryx\Glue\ProductListsRestApi\Processor\Updater;

use Generated\Shared\Transfer\RestProductListsAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface ProductListUpdaterInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestProductListsAttributesTransfer $restProductListsAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function update(
        RestRequestInterface $restRequest,
        RestProductListsAttributesTransfer $restProductListsAttributesTransfer
    ): RestResponseInterface;
}
