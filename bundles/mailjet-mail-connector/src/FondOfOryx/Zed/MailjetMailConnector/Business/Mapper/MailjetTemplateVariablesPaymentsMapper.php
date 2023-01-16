<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\PaymentTransfer;

class MailjetTemplateVariablesPaymentsMapper implements MailjetTemplateVariablesTransferCollectionMapperInterface
{
    /**
     * @var string
     */
    public const PAYMENT_PROVIDER = 'paymentProvider';

    /**
     * @var string
     */
    public const PAYMENT_METHOD = 'paymentMethod';

    /**
     * @var string
     */
    public const ACCOUNT_HOLDER = 'accountHolder';

    /**
     * @var string
     */
    public const BANK = 'bank';

    /**
     * @var string
     */
    public const IBAN = 'iban';

    /**
     * @var string
     */
    public const BIC = 'bic';

    /**
     * @param \ArrayObject<(\Spryker\Shared\Kernel\Transfer\AbstractTransfer|\Generated\Shared\Transfer\PaymentTransfer)> $arrayObject
     *
     * @return array<array<string, mixed>>
     */
    public function map(ArrayObject $arrayObject): array
    {
        $payments = [];

        /** @var \Generated\Shared\Transfer\PaymentTransfer $paymentTransfer */
        foreach ($arrayObject as $paymentTransfer) {
            $payments[] = $this->paymentTransferToArray($paymentTransfer);
        }

        return $payments;
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentTransfer $paymentTransfer
     *
     * @return array<string, mixed>
     */
    protected function paymentTransferToArray(PaymentTransfer $paymentTransfer): array
    {
        return [
            static::PAYMENT_PROVIDER => $paymentTransfer->getPaymentProvider(),
            static::PAYMENT_METHOD => $paymentTransfer->getPaymentMethod(),
            static::ACCOUNT_HOLDER => $paymentTransfer->getAccountHolder(),
            static::BANK => $paymentTransfer->getBank(),
            static::IBAN => $paymentTransfer->getIban(),
            static::BIC => $paymentTransfer->getBic(),
        ];
    }
}
