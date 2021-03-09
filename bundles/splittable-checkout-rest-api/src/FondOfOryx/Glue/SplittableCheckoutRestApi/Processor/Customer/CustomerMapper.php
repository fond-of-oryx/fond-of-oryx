<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Customer;

use Generated\Shared\Transfer\RestCustomerTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CustomerMapper implements CustomerMapperInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Customer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCustomerTransfer
     */
    public function mapRestCustomerTransferFromRestSplittableCheckoutRequest(
        RestRequestInterface $restRequest,
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
    ): RestCustomerTransfer {
        $restCustomerTransfer = new RestCustomerTransfer();

        if (!$restRequest->getUser()) {
            return $restCustomerTransfer;
        }

        if ($restSplittableCheckoutRequestAttributesTransfer->getCustomer()) {
            $restCustomerTransfer->fromArray(
                $restSplittableCheckoutRequestAttributesTransfer->getCustomer()->toArray(),
                true
            );
        }

        $restCustomerTransfer->setCustomerReference($restRequest->getUser()->getNaturalIdentifier());

        if ($restRequest->getUser()->getSurrogateIdentifier()) {
            return $restCustomerTransfer->setIdCustomer((int)$restRequest->getUser()->getSurrogateIdentifier());
        }

        return $restCustomerTransfer->setIdCustomer(null);
    }
}
