<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Dependency;

use Generated\Shared\Transfer\CustomerResponseTransfer;
use Spryker\Zed\Customer\Business\CustomerFacadeInterface;

class ReturnLabelsRestApiToCustomerFacadeBridge implements ReturnLabelsRestApiToCustomerFacadeInterface
{
    protected $customerFacade;

    /**
     * @param \Spryker\Zed\Customer\Business\CustomerFacadeInterface $customerFacade
     */
    public function __construct(CustomerFacadeInterface $customerFacade)
    {
        $this->customerFacade = $customerFacade;
    }

    /**
     * Specification:
     *  - Finds customer by reference.
     *  - Returns customer response transfer.
     *
     * @api
     *
     * @param string $customerReference
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function findCustomerByReference(string $customerReference): CustomerResponseTransfer
    {
        return $this->customerFacade->findCustomerByReference($customerReference);
    }
}
