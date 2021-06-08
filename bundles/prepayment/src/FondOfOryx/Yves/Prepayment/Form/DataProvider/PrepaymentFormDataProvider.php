<?php

namespace FondOfOryx\Yves\Prepayment\Form\DataProvider;

use Generated\Shared\Transfer\PaymentTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface;

class PrepaymentFormDataProvider implements StepEngineFormDataProviderInterface
{
    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $dataTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    public function getData(AbstractTransfer $dataTransfer)
    {
        if (method_exists($dataTransfer, 'getPayment') && method_exists($dataTransfer, 'setPayment') && $dataTransfer->getPayment() === null) {
            $dataTransfer->setPayment(new PaymentTransfer());
        }

        return $dataTransfer;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $dataTransfer
     *
     * @return array
     */
    public function getOptions(AbstractTransfer $dataTransfer)
    {
        return [];
    }
}
