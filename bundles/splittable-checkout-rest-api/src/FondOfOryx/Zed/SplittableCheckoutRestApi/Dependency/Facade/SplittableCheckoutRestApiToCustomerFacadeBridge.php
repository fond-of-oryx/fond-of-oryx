<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade;

use Generated\Shared\Transfer\CustomerResponseTransfer;

class SplittableCheckoutRestApiToCustomerFacadeBridge implements SplittableCheckoutRestApiToCustomerFacadeInterface
{
    /**
     * @var \Spryker\Zed\Customer\Business\CustomerFacadeInterface
     */
    protected $customerFacade;

    /**
     * @param \Spryker\Zed\Customer\Business\CustomerFacadeInterface $customerFacade
     */
    public function __construct($customerFacade)
    {
        $this->customerFacade = $customerFacade;
    }

    /**
     * @param string $customerReference
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function findCustomerByReference(string $customerReference): CustomerResponseTransfer
    {
        return $this->customerFacade->findCustomerByReference($customerReference);
    }
}
