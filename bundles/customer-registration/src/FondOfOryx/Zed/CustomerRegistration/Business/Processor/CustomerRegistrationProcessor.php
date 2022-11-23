<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Processor;

use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerRegistrationResponseTransfer;

class CustomerRegistrationProcessor implements CustomerRegistrationProcessorInterface
{
    /**
     * @var array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPluginInterface>
     */
    protected $plugins;

    /**
     * @param array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPluginInterface> $plugins
     */
    public function __construct(array $plugins)
    {
        $this->plugins = $plugins;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationResponseTransfer
     */
    public function processCustomerRegistration(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationResponseTransfer
    {
        foreach ($this->plugins as $plugin) {
            $customerRegistrationRequestTransfer = $plugin->execute($customerRegistrationRequestTransfer);
        }

        return $this->createResponse($customerRegistrationRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationResponseTransfer
     */
    protected function createResponse(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationResponseTransfer
    {
        return (new CustomerRegistrationResponseTransfer())->fromArray($customerRegistrationRequestTransfer->getBagOrFail()->toArray(), true);
    }
}
