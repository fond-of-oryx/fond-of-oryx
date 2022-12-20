<?php

namespace FondOfOryx\Glue\PayoneRestApi\Handler;

use FondOfOryx\Shared\PayoneRestApi\PayoneRestApiConstants;
use Generated\Shared\Transfer\PaymentDetailTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\PayonePaymentTransfer;
use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestPaymentTransfer;
use Spryker\Shared\Kernel\Store;

class PayoneHandler implements PayoneHandlerInterface
{
    /**
     * @var string
     */
    public const PAYMENT_PROVIDER = 'Payone';

    /**
     * @var string
     */
    public const CHECKOUT_INCLUDE_SUMMARY_PATH = 'Payone/partial/summary';

    /**
     * @var string
     */
    public const CHECKOUT_INCLUDE_SUCCESS_PATH = 'Payone/partial/success';

    /**
     * @var string
     */
    protected const PAYONE_PAYMENT_REFERENCE_PREFIX = 'TX1';

    /**
     * @var array
     */
    protected static $payonePaymentMethodMapper = [
        PaymentTransfer::PAYONE_CREDIT_CARD => PayoneRestApiConstants::PAYMENT_METHOD_CREDITCARD,
        PaymentTransfer::PAYONE_E_WALLET => PayoneRestApiConstants::PAYMENT_METHOD_E_WALLET,
        PaymentTransfer::PAYONE_DIRECT_DEBIT => PayoneRestApiConstants::PAYMENT_METHOD_DIRECT_DEBIT,
        PaymentTransfer::PAYONE_INSTANT_ONLINE_TRANSFER => PayoneRestApiConstants::PAYMENT_METHOD_ONLINE_BANK_TRANSFER,
        PaymentTransfer::PAYONE_EPS_ONLINE_TRANSFER => PayoneRestApiConstants::PAYMENT_METHOD_ONLINE_BANK_TRANSFER,
        PaymentTransfer::PAYONE_GIROPAY_ONLINE_TRANSFER => PayoneRestApiConstants::PAYMENT_METHOD_ONLINE_BANK_TRANSFER,
        PaymentTransfer::PAYONE_IDEAL_ONLINE_TRANSFER => PayoneRestApiConstants::PAYMENT_METHOD_ONLINE_BANK_TRANSFER,
        PaymentTransfer::PAYONE_POSTFINANCE_EFINANCE_ONLINE_TRANSFER => PayoneRestApiConstants::PAYMENT_METHOD_ONLINE_BANK_TRANSFER,
        PaymentTransfer::PAYONE_PRZELEWY24_ONLINE_TRANSFER => PayoneRestApiConstants::PAYMENT_METHOD_ONLINE_BANK_TRANSFER,
        PaymentTransfer::PAYONE_BANCONTACT_ONLINE_TRANSFER => PayoneRestApiConstants::PAYMENT_METHOD_ONLINE_BANK_TRANSFER,
        PaymentTransfer::PAYONE_PRE_PAYMENT => PayoneRestApiConstants::PAYMENT_METHOD_PREPAYMENT,
        PaymentTransfer::PAYONE_INVOICE => PayoneRestApiConstants::PAYMENT_METHOD_INVOICE,
        PaymentTransfer::PAYONE_SECURITY_INVOICE => PayoneRestApiConstants::PAYMENT_METHOD_SECURITY_INVOICE,
        PaymentTransfer::PAYONE_CASH_ON_DELIVERY => PayoneRestApiConstants::PAYMENT_METHOD_CASH_ON_DELIVERY,
        PaymentTransfer::PAYONE_KLARNA => PayoneRestApiConstants::PAYMENT_METHOD_KLARNA,
    ];

    /**
     * @param \Generated\Shared\Transfer\RestPaymentTransfer $restPaymentTransfer
     * @param \Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTransfer
     */
    public function preparePayment(
        RestPaymentTransfer $restPaymentTransfer,
        RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
    ): PaymentTransfer {
        $paymentTransfer = new PaymentTransfer();
        $paymentSelection = $restPaymentTransfer->getPaymentSelection();

        $this->setPaymentProviderAndMethod($paymentTransfer, $paymentSelection);
        $this->setPayonePayment($paymentTransfer, $restCheckoutRequestAttributesTransfer, $restPaymentTransfer, $paymentSelection);
        $this->setPaymentSuccessIncludePath($paymentTransfer);

        return $paymentTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentTransfer $paymentTransfer
     * @param string $paymentSelection
     *
     * @return void
     */
    protected function setPaymentProviderAndMethod(PaymentTransfer $paymentTransfer, string $paymentSelection): void
    {
        $paymentTransfer
            ->setPaymentProvider(static::PAYMENT_PROVIDER)
            ->setPaymentMethod(static::$payonePaymentMethodMapper[$paymentSelection]);
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentTransfer $paymentTransfer
     *
     * @return void
     */
    protected function setPaymentSuccessIncludePath(PaymentTransfer $paymentTransfer): void
    {
        $paymentTransfer->setSummaryIncludePath(self::CHECKOUT_INCLUDE_SUMMARY_PATH);
        $paymentTransfer->setSuccessIncludePath(self::CHECKOUT_INCLUDE_SUCCESS_PATH);
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentTransfer $paymentTransfer
     * @param \Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer $requestAttributesTransfer
     * @param \Generated\Shared\Transfer\RestPaymentTransfer $restPaymentTransfer
     * @param string $paymentSelection
     *
     * @return void
     */
    protected function setPayonePayment(
        PaymentTransfer $paymentTransfer,
        RestCheckoutRequestAttributesTransfer $requestAttributesTransfer,
        RestPaymentTransfer $restPaymentTransfer,
        string $paymentSelection
    ): void {
        $payonePaymentTransfer = $this->getPayonePaymentTransfer($restPaymentTransfer, $paymentSelection);

        $paymentDetailTransfer = new PaymentDetailTransfer();
        $paymentDetailTransfer->setCurrency($this->getCurrency());
        if ($paymentSelection === PaymentTransfer::PAYONE_CREDIT_CARD) {
            $paymentDetailTransfer->setPseudoCardPan($payonePaymentTransfer->getPseudocardpan());
        } elseif ($paymentSelection === PaymentTransfer::PAYONE_E_WALLET) {
            $paymentDetailTransfer->setType($payonePaymentTransfer->getWallettype());
        } elseif ($paymentSelection === PaymentTransfer::PAYONE_DIRECT_DEBIT) {
            $paymentDetailTransfer->setBankCountry($payonePaymentTransfer->getBankcountry());
            $paymentDetailTransfer->setBankAccount($payonePaymentTransfer->getBankaccount());
            $paymentDetailTransfer->setBankCode($payonePaymentTransfer->getBankcode());
            $paymentDetailTransfer->setBic($payonePaymentTransfer->getBic());
            $paymentDetailTransfer->setIban($payonePaymentTransfer->getIban());
            $paymentDetailTransfer->setMandateIdentification($payonePaymentTransfer->getMandateIdentification());
            $paymentDetailTransfer->setMandateText($payonePaymentTransfer->getMandateText());
        } elseif (
            $paymentSelection === PaymentTransfer::PAYONE_EPS_ONLINE_TRANSFER
            || $paymentSelection === PaymentTransfer::PAYONE_INSTANT_ONLINE_TRANSFER
            || $paymentSelection === PaymentTransfer::PAYONE_GIROPAY_ONLINE_TRANSFER
            || $paymentSelection === PaymentTransfer::PAYONE_IDEAL_ONLINE_TRANSFER
            || $paymentSelection === PaymentTransfer::PAYONE_POSTFINANCE_EFINANCE_ONLINE_TRANSFER
            || $paymentSelection === PaymentTransfer::PAYONE_POSTFINANCE_CARD_ONLINE_TRANSFER
            || $paymentSelection === PaymentTransfer::PAYONE_PRZELEWY24_ONLINE_TRANSFER
            || $paymentSelection === PaymentTransfer::PAYONE_BANCONTACT_ONLINE_TRANSFER
        ) {
            $paymentDetailTransfer->setType($payonePaymentTransfer->getOnlineBankTransferType());
            $paymentDetailTransfer->setBankCountry($payonePaymentTransfer->getBankCountry());
            if ($paymentSelection === PaymentTransfer::PAYONE_BANCONTACT_ONLINE_TRANSFER) {
                $paymentDetailTransfer->setBankCountry($requestAttributesTransfer->getBillingAddress()->getIso2Code());
            }
            $paymentDetailTransfer->setBankAccount($payonePaymentTransfer->getBankAccount());
            $paymentDetailTransfer->setBankCode($payonePaymentTransfer->getBankCode());
            $paymentDetailTransfer->setBankBranchCode($payonePaymentTransfer->getBankBranchCode());
            $paymentDetailTransfer->setBankCheckDigit($payonePaymentTransfer->getBankCheckDigit());
            $paymentDetailTransfer->setBankGroupType($payonePaymentTransfer->getBankGroupType());
            $paymentDetailTransfer->setIban($payonePaymentTransfer->getIban());
            $paymentDetailTransfer->setBic($payonePaymentTransfer->getBic());
        } elseif ($paymentSelection == PaymentTransfer::PAYONE_CASH_ON_DELIVERY) {
            $shippingProvider = $requestAttributesTransfer->getShipment()->getCarrierName();
            $paymentDetailTransfer->setShippingProvider($shippingProvider);
        }

        $payonePaymentTransfer = new PayonePaymentTransfer();
        $payonePaymentTransfer->setReference(uniqid(self::PAYONE_PAYMENT_REFERENCE_PREFIX));
        $payonePaymentTransfer->setPaymentDetail($paymentDetailTransfer);
        $payonePaymentTransfer->setPaymentMethod($paymentTransfer->getPaymentMethod());
        $paymentTransfer->setPayone($payonePaymentTransfer);
    }

    /**
     * @return string
     */
    protected function getCurrency(): string
    {
        return Store::getInstance()->getCurrencyIsoCode();
    }

    /**
     * @param \Generated\Shared\Transfer\RestPaymentTransfer $restPaymentTransfer
     * @param string $paymentSelection
     *
     * @return \Generated\Shared\Transfer\PayonePaymentCreditCardTransfer|\Generated\Shared\Transfer\PayonePaymentEWalletTransfer|\Generated\Shared\Transfer\PayonePaymentDirectDebitTransfer|\Generated\Shared\Transfer\PayonePaymentOnlinetransferTransfer
     */
    protected function getPayonePaymentTransfer(RestPaymentTransfer $restPaymentTransfer, string $paymentSelection)
    {
        $method = 'get' . ucfirst($paymentSelection);

        return $restPaymentTransfer->$method();
    }
}
