<?php

namespace FondOfOryx\Yves\Prepayment\Form;

use FondOfOryx\Shared\Prepayment\PrepaymentConstants;
use Spryker\Yves\StepEngine\Dependency\Form\AbstractSubFormType;
use Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface;
use Spryker\Yves\StepEngine\Dependency\Form\SubFormProviderNameInterface;

/**
 * @method \FondOfOryx\Yves\Prepayment\PrepaymentFactory getFactory()
 */
abstract class AbstractSubForm extends AbstractSubFormType implements SubFormInterface, SubFormProviderNameInterface
{
    /**
     * @return string
     */
    public function getProviderName(): string
    {
        return PrepaymentConstants::PROVIDER_NAME;
    }

    /**
     * @return array
     */
    protected function getAdditionalFormVars(): array
    {
        return $this->getFactory()->createAdditionalFormVars();
    }
}
