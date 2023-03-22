<?php

namespace FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Handler;

use FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Dependency\CheckoutRestApiPayoneConnectorToStoreClientBridgeInterface;
use Generated\Shared\Transfer\PaymentDetailTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\PayonePaymentTransfer;
use Generated\Shared\Transfer\RestPaymentTransfer;
use SprykerEco\Shared\Payone\PayoneApiConstants;

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
        PaymentTransfer::PAYONE_CREDIT_CARD => PayoneApiConstants::PAYMENT_METHOD_CREDITCARD,
        PaymentTransfer::PAYONE_E_WALLET => PayoneApiConstants::PAYMENT_METHOD_E_WALLET,
    ];

    /**
     * @var \FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Dependency\CheckoutRestApiPayoneConnectorToStoreClientBridgeInterface
     */
    private $storeClient;

    /**
     * @param \FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Dependency\CheckoutRestApiPayoneConnectorToStoreClientBridgeInterface $storeClient
     */
    public function __construct(CheckoutRestApiPayoneConnectorToStoreClientBridgeInterface $storeClient)
    {
        $this->storeClient = $storeClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestPaymentTransfer $restPaymentTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTransfer
     */
    public function preparePayment(
        RestPaymentTransfer $restPaymentTransfer
    ): PaymentTransfer {
        $paymentTransfer = new PaymentTransfer();
        $paymentSelection = $restPaymentTransfer->getPaymentSelection();

        $this->setPaymentProviderAndMethod($paymentTransfer, $paymentSelection);
        $this->setPayonePayment($paymentTransfer, $restPaymentTransfer, $paymentSelection);
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
     * @param \Generated\Shared\Transfer\RestPaymentTransfer $restPaymentTransfer
     * @param string $paymentSelection
     *
     * @return void
     */
    protected function setPayonePayment(
        PaymentTransfer $paymentTransfer,
        RestPaymentTransfer $restPaymentTransfer,
        string $paymentSelection
    ): void {
        $restPayoneTransfer = $this->getRestPayoneTransfer($restPaymentTransfer, $paymentSelection);

        $paymentDetailTransfer = new PaymentDetailTransfer();
        $paymentDetailTransfer->setCurrency($this->getCurrency());

        switch ($paymentSelection) {
            case PaymentTransfer::PAYONE_CREDIT_CARD:
                $paymentDetailTransfer->setPseudoCardPan($restPayoneTransfer->getPseudoCardPan());

                break;
            case PaymentTransfer::PAYONE_E_WALLET:
                $paymentDetailTransfer->setType($restPayoneTransfer->getWalletType());

                break;
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
        return $this->storeClient->getCurrencyIsoCode();
    }

    /**
     * @param \Generated\Shared\Transfer\RestPaymentTransfer $restPaymentTransfer
     * @param string $paymentSelection
     *
     * @return \Generated\Shared\Transfer\RestPayoneEWalletTransfer|\Generated\Shared\Transfer\RestPayoneCreditCardTransfer
     */
    protected function getRestPayoneTransfer(RestPaymentTransfer $restPaymentTransfer, string $paymentSelection)
    {
        $method = 'get' . ucfirst($paymentSelection);

        return $restPaymentTransfer->$method();
    }
}
