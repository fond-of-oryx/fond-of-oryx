<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Generator;

use FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfig;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToSequenceNumberFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToStoreFacadeInterface;

class CustomerReferenceGenerator implements CustomerReferenceGeneratorInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToSequenceNumberFacadeInterface
     */
    protected $sequenceNumberFacade;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToStoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToSequenceNumberFacadeInterface $sequenceNumberFacade
     * @param \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToStoreFacadeInterface $storeFacade
     * @param \FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfig $config
     */
    public function __construct(
        CustomerRegistrationToSequenceNumberFacadeInterface $sequenceNumberFacade,
        CustomerRegistrationToStoreFacadeInterface $storeFacade,
        CustomerRegistrationConfig $config
    ) {
        $this->sequenceNumberFacade = $sequenceNumberFacade;
        $this->storeFacade = $storeFacade;
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function generateCustomerReference(): string
    {
        $storeName = $this->storeFacade->getCurrentStore()->getNameOrFail();

        return $this->sequenceNumberFacade->generate(
            $this->config->getCustomerReferenceDefaults($storeName),
        );
    }
}
