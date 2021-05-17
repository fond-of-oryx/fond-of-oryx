<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Dependency\Facade;

use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Customer\Business\CustomerFacadeInterface;

class ReturnLabelsRestApiCustomerConnectorToCustomerFacadeBridge implements ReturnLabelsRestApiCustomerConnectorToCustomerFacadeInterface
{
    /**
     * @var \Spryker\Zed\Customer\Business\CustomerFacadeInterface
     */
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
     * - Retrieves customer information with customer addresses and locale information by customer ID.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    public function findCustomerById(CustomerTransfer $customerTransfer): ?CustomerTransfer
    {
        return $this->customerFacade->findCustomerById($customerTransfer);
    }
}
