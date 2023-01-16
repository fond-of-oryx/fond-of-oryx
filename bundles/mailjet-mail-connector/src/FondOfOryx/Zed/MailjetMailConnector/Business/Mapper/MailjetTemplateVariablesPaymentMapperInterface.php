<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Mapper;

use Generated\Shared\Transfer\PaymentTransfer;

interface MailjetTemplateVariablesPaymentMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\PaymentTransfer $paymentTransfer
     *
     * @return array<string, mixed>
     */
    public function paymentTransferToArray(PaymentTransfer $paymentTransfer): array;
}
