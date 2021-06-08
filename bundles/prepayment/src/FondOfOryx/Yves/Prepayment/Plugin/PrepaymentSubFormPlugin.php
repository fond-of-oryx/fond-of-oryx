<?php

namespace FondOfOryx\Yves\Prepayment\Plugin;

use Spryker\Yves\Kernel\AbstractPlugin;
use Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginInterface;

/**
 * @method \FondOfOryx\Yves\Prepayment\PrepaymentFactory getFactory()
 */
class PrepaymentSubFormPlugin extends AbstractPlugin implements SubFormPluginInterface
{
    /**
     * @return \FondOfOryx\Yves\Prepayment\Form\PrepaymentSubForm
     */
    public function createSubForm()
    {
        return $this->getFactory()->createPrepaymentForm();
    }

    /**
     * @return \Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface
     */
    public function createSubFormDataProvider()
    {
        return $this->getFactory()->createPrepaymentFormDataProvider();
    }
}
