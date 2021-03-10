<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApiExtension\Dependency\Plugin;

use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

/**
 * Plugin interface is used to expand the `RestSplittableCheckoutRequestAttributesTransfer` with additional information.
 *
 * Executes before sending the checkout-data or checkout Zed requests.
 */
interface SplittableCheckoutRequestExpanderPluginInterface
{
    /**
     * Specification:
     * - Expands `RestSplittableCheckoutRequestAttributesTransfer` with additional data.
     * - Uses `RestRequest`.
     *
     * @api
     *
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer
     */
    public function expand(
        RestRequestInterface $restRequest,
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
    ): RestSplittableCheckoutRequestAttributesTransfer;
}
