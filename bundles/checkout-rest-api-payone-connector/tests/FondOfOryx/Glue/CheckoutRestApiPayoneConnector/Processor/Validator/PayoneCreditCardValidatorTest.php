<?php

namespace FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Processor\Validator;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CheckoutRestApiPayoneConnector\CheckoutRestApiPayoneConnectorConfig;
use Generated\Shared\Transfer\RestPaymentTransfer;
use Generated\Shared\Transfer\RestPayoneCreditCardTransfer;

class PayoneCreditCardValidatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Processor\Validator\PayoneCreditCardValidator
     */
    private $validator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->validator = new PayoneCreditCardValidator();
    }

    /**
     * @return void
     */
    public function testValidateWithPseudoCardPan(): void
    {
        $payoneCreditCard = (new RestPayoneCreditCardTransfer())->setPseudoCardPan('1234567890');
        $restPayment = (new RestPaymentTransfer())->setPayoneCreditCard($payoneCreditCard);
        $errorCollection = $this->validator->validate($restPayment);
        $this->assertCount(0, $errorCollection->getRestErrors());
    }

    /**
     * @return void
     */
    public function testValidateCreditCardErrorMessage(): void
    {
        $payoneCreditCard = (new RestPayoneCreditCardTransfer());
        $restPayment = (new RestPaymentTransfer())->setPayoneCreditCard($payoneCreditCard);
        $errorCollection = $this->validator->validate($restPayment);

        $this->assertEquals(
            CheckoutRestApiPayoneConnectorConfig::RESPONSE_CODE_PSEUDOCARDPAN_MISSING,
            $errorCollection->getRestErrors()->offsetGet(0)->getCode(),
        );
        $this->assertEquals(
            CheckoutRestApiPayoneConnectorConfig::RESPONSE_DETAILS_PSEUDOCARDPAN_MISSING,
            $errorCollection->getRestErrors()->offsetGet(0)->getDetail(),
        );
    }

    /**
     * @return void
     */
    public function testValidateWithoutPseudoCardPan(): void
    {
        $payoneCreditCard = (new RestPayoneCreditCardTransfer());
        $restPayment = (new RestPaymentTransfer())->setPayoneCreditCard($payoneCreditCard);
        $errorCollection = $this->validator->validate($restPayment);

        $this->assertCount(1, $errorCollection->getRestErrors());
    }
}
