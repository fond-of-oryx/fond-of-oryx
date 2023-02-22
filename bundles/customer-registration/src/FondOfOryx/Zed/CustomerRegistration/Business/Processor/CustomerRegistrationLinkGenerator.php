<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Processor;

use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToOneTimePasswordFacadeInterface;

class CustomerRegistrationLinkGenerator implements CustomerRegistrationLinkGeneratorInterface
{
    protected CustomerRegistrationToOneTimePasswordFacadeInterface $oneTimePasswordFacade;

    /**
     * @param \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToOneTimePasswordFacadeInterface $oneTimePasswordFacade
     */
    public function __construct(CustomerRegistrationToOneTimePasswordFacadeInterface $oneTimePasswordFacade)
    {
        $this->oneTimePasswordFacade = $oneTimePasswordFacade;
    }
}
