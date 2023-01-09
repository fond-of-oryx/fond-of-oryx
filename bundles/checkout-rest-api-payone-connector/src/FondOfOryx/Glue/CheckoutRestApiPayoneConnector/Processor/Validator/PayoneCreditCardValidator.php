<?php

namespace FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Processor\Validator;

use FondOfOryx\Glue\CheckoutRestApiPayoneConnector\CheckoutRestApiPayoneConnectorConfig;
use Generated\Shared\Transfer\RestErrorCollectionTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestPaymentTransfer;
use Symfony\Component\HttpFoundation\Response;

class PayoneCreditCardValidator implements ValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestPaymentTransfer $restPaymentTransfer
     *
     * @return \Generated\Shared\Transfer\RestErrorCollectionTransfer
     */
    public function validate(RestPaymentTransfer $restPaymentTransfer): RestErrorCollectionTransfer
    {
        $restErrorCollectionTransfer = new RestErrorCollectionTransfer();

        if ($restPaymentTransfer->getPayoneCreditCard()->getPseudoCardPan() === null) {
            $restErrorMessageTransfer = (new RestErrorMessageTransfer())
                ->setStatus(Response::HTTP_BAD_REQUEST)
                ->setCode(CheckoutRestApiPayoneConnectorConfig::RESPONSE_CODE_PSEUDOCARDPAN_MISSING)
                ->setDetail(CheckoutRestApiPayoneConnectorConfig::RESPONSE_DETAILS_PSEUDOCARDPAN_MISSING);
            $restErrorCollectionTransfer->addRestError($restErrorMessageTransfer);
        }

        return $restErrorCollectionTransfer;
    }
}
