<?php

namespace FondOfOryx\Yves\Prepayment;

use FondOfOryx\Yves\Prepayment\Form\DataProvider\PrepaymentFormDataProvider;
use FondOfOryx\Yves\Prepayment\Form\PrepaymentSubForm;
use FondOfOryx\Yves\Prepayment\Handler\PrepaymentHandler;
use Spryker\Yves\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Yves\Prepayment\PrepaymentConfig getConfig()
 */
class PrepaymentFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Yves\Prepayment\Form\PrepaymentSubForm
     */
    public function createPrepaymentForm()
    {
        return new PrepaymentSubForm();
    }

    /**
     * @return \FondOfOryx\Yves\Prepayment\Form\DataProvider\PrepaymentFormDataProvider
     */
    public function createPrepaymentFormDataProvider()
    {
        return new PrepaymentFormDataProvider();
    }

    /**
     * @return \FondOfOryx\Yves\Prepayment\Handler\PrepaymentHandler
     */
    public function createPrepaymentHandler()
    {
        return new PrepaymentHandler();
    }

    /**
     * @return array
     */
    public function createAdditionalFormVars()
    {
        return [
            'iban' => $this->getConfig()->getIban(),
            'bic' => $this->getConfig()->getBic(),
            'accountHolder' => $this->getConfig()->getAccountHolder(),
            'customText' => $this->getConfig()->getCustomText(),
        ];
    }
}
