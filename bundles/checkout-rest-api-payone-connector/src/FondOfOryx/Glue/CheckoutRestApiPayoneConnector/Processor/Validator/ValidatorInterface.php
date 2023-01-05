<?php

namespace FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Processor\Validator;

use Generated\Shared\Transfer\RestErrorCollectionTransfer;
use Generated\Shared\Transfer\RestPaymentTransfer;

interface ValidatorInterface
{
    /**
     * @param RestPaymentTransfer $restPaymentTransfer
     *
     * @return RestErrorCollectionTransfer
     */
    public function validate(RestPaymentTransfer $restPaymentTransfer): RestErrorCollectionTransfer;
}
