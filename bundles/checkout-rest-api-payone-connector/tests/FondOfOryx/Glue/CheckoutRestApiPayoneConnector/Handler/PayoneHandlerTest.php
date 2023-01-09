<?php

namespace FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Handler;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Dependency\CheckoutRestApiPayoneConnectorToStoreClientBridge;
use Generated\Shared\Transfer\RestPaymentTransfer;
use Generated\Shared\Transfer\RestPayoneCreditCardTransfer;
use Generated\Shared\Transfer\RestPayoneEWalletTransfer;
use SprykerEco\Shared\Payone\PayoneApiConstants;

class PayoneHandlerTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Handler\PayoneHandler
     */
    private $payoneHandler;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $storeClientMock = $this->getMockBuilder(CheckoutRestApiPayoneConnectorToStoreClientBridge::class)
            ->disableOriginalConstructor()
            ->getMock();
        $storeClientMock->method('getCurrencyIsoCode')->willReturn('EUR');
        $this->payoneHandler = new PayoneHandler($storeClientMock);
    }

    /**
     * @return void
     */
    public function testPreparePaymentCreditCard(): void
    {
        $payoneCreditCard = (new RestPayoneCreditCardTransfer())->setPseudoCardPan('1234567890');
        $restPayment = (new RestPaymentTransfer())
            ->setPayoneCreditCard($payoneCreditCard)
            ->setPaymentSelection('payoneCreditCard');
        $payment = $this->payoneHandler->preparePayment($restPayment);

        $this->assertEquals(PayoneApiConstants::PAYMENT_METHOD_CREDITCARD, $payment->getPaymentMethod());
        $this->assertEquals('1234567890', $payment->getPayone()->getPaymentDetail()->getPseudoCardPan());
    }

    /**
     * @return void
     */
    public function testPreparePaymentEWallet(): void
    {
        $payoneEWallet = (new RestPayoneEWalletTransfer())->setWalletType('PPE');
        $restPayment = (new RestPaymentTransfer())
            ->setPayoneEWallet($payoneEWallet)
            ->setPaymentSelection('payoneEWallet');
        $payment = $this->payoneHandler->preparePayment($restPayment);

        $this->assertEquals(PayoneApiConstants::PAYMENT_METHOD_E_WALLET, $payment->getPaymentMethod());
        $this->assertEquals('PPE', $payment->getPayone()->getPaymentDetail()->getType());
    }

    /**
     * @return void
     */
    public function testPreparePaymentIncludePath(): void
    {
        $payoneCreditCard = (new RestPayoneCreditCardTransfer())->setPseudoCardPan('1234567890');
        $restPayment = (new RestPaymentTransfer())
            ->setPayoneCreditCard($payoneCreditCard)
            ->setPaymentSelection('payoneCreditCard');
        $payment = $this->payoneHandler->preparePayment($restPayment);

        $this->assertEquals('Payone/partial/summary', $payment->getSummaryIncludePath());
        $this->assertEquals('Payone/partial/success', $payment->getSuccessIncludePath());
    }
}
