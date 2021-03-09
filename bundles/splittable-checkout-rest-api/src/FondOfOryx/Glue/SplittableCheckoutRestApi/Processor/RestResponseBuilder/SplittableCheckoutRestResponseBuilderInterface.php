<?php


namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\RestResponseBuilder;

use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface SplittableCheckoutRestResponseBuilderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer $restSplittableCheckoutResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createSplittableCheckoutRestResponse(
        RestSplittableCheckoutResponseTransfer $restSplittableCheckoutResponseTransfer
    ): RestResponseInterface;

    /**
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\RestResponseBuilder|\ArrayObject $errors
     * @param string $locale
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createPlaceOrderFailedErrorResponse(
        ArrayObject $errors,
        string $locale
    ): RestResponseInterface;


}
