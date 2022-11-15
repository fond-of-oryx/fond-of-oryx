<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Steps;

use Generated\Shared\Transfer\CustomerRegistrationBagTransfer;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;

abstract class AbstractStep
{
    /**
     * @var array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPreStepConditionPluginInterface>
     */
    protected $preStepPlugins = [];

    /**
     * @var array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface>
     */
    protected $postStepPlugins = [];

    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationBagTransfer
     */
    protected function getBag(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationBagTransfer
    {
        $bag = $customerRegistrationRequestTransfer->getBag();
        if ($bag === null) {
            $bag = new CustomerRegistrationBagTransfer();
        }

        return $bag;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    protected function executePostStepPlugins(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer
    {
        foreach ($this->postStepPlugins as $plugin) {
            $customerRegistrationRequestTransfer = $plugin->execute($customerRegistrationRequestTransfer);
        }

        return $customerRegistrationRequestTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return bool
     */
    protected function checkPreConditions(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): bool
    {
        foreach ($this->preStepPlugins as $plugin) {
            if ($plugin->checkPreCondition($customerRegistrationRequestTransfer) === false) {
                return false;
            }
        }

        return true;
    }
}
