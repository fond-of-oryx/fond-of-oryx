<?php

namespace FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Processor\Validator;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CheckoutRestApiPayoneConnector\CheckoutRestApiPayoneConnectorConfig;
use Generated\Shared\Transfer\RestPaymentTransfer;
use Generated\Shared\Transfer\RestPayoneEWalletTransfer;

class PayoneEWalletValidatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Processor\Validator\PayoneEWalletValidator
     */
    protected PayoneEWalletValidator $validator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->validator = new PayoneEWalletValidator();
    }

    /**
     * @return void
     */
    public function testValidateWithPaypal(): void
    {
        $payoneEWallet = (new RestPayoneEWalletTransfer())->setWalletType('PPE');
        $restPayment = (new RestPaymentTransfer())->setPayoneEWallet($payoneEWallet);
        $errorCollection = $this->validator->validate($restPayment);
        $this->assertCount(0, $errorCollection->getRestErrors());
    }

    /**
     * @return void
     */
    public function testValidateEWalletErrorMessage(): void
    {
        $payoneEWallet = (new RestPayoneEWalletTransfer());
        $restPayment = (new RestPaymentTransfer())->setPayoneEWallet($payoneEWallet);
        $errorCollection = $this->validator->validate($restPayment);

        $this->assertEquals(
            CheckoutRestApiPayoneConnectorConfig::RESPONSE_CODE_WALLETTYPE_INCORRECT,
            $errorCollection->getRestErrors()->offsetGet(0)->getCode(),
        );
        $this->assertEquals(
            CheckoutRestApiPayoneConnectorConfig::RESPONSE_DETAILS_WALLETTYPE_INCORRECT,
            $errorCollection->getRestErrors()->offsetGet(0)->getDetail(),
        );
    }

    /**
     * @return void
     */
    public function testValidateWithoutWalletType(): void
    {
        $payoneEWallet = (new RestPayoneEWalletTransfer());
        $restPayment = (new RestPaymentTransfer())->setPayoneEWallet($payoneEWallet);
        $errorCollection = $this->validator->validate($restPayment);

        $this->assertCount(1, $errorCollection->getRestErrors());
    }
}
