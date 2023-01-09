<?php

namespace FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Processor\Validator;

use FondOfOryx\Glue\CheckoutRestApiPayoneConnector\CheckoutRestApiPayoneConnectorConfig;
use Generated\Shared\Transfer\RestErrorCollectionTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestPaymentTransfer;
use Symfony\Component\HttpFoundation\Response;

class PayoneEWalletValidator implements ValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestPaymentTransfer $restPaymentTransfer
     *
     * @return \Generated\Shared\Transfer\RestErrorCollectionTransfer
     */
    public function validate(RestPaymentTransfer $restPaymentTransfer): RestErrorCollectionTransfer
    {
        $restErrorCollectionTransfer = new RestErrorCollectionTransfer();
        if ($restPaymentTransfer->getPayoneEWallet()->getWalletType() === null) {
            $restErrorMessageTransfer = (new RestErrorMessageTransfer())
                ->setStatus(Response::HTTP_BAD_REQUEST)
                ->setCode(CheckoutRestApiPayoneConnectorConfig::RESPONSE_CODE_WALLETTYPE_INCORRECT)
                ->setDetail(CheckoutRestApiPayoneConnectorConfig::RESPONSE_DETAILS_WALLETTYPE_INCORRECT);
            $restErrorCollectionTransfer->addRestError($restErrorMessageTransfer);
        }

        return $restErrorCollectionTransfer;
    }
}
