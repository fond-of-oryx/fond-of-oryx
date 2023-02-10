<?php

namespace FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business\Processor;

use FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;

class RegistrationProcessor implements RegistrationProcessorInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerFacadeInterface
     */
    protected CustomerRegistrationSalesConnectorToCustomerFacadeInterface $customerFacade;

    /**
     * @param \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerFacadeInterface $customerFacade
     */
    public function __construct(CustomerRegistrationSalesConnectorToCustomerFacadeInterface $customerFacade)
    {
        $this->customerFacade = $customerFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\SaveOrderTransfer $saveOrderTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SaveOrderTransfer
     */
    public function processRegistration(SaveOrderTransfer $saveOrderTransfer, QuoteTransfer $quoteTransfer): SaveOrderTransfer
    {
        if ($quoteTransfer->getCustomer() === null) {
            return $saveOrderTransfer;
        }

        if ($quoteTransfer->getCreateAccount() === true && $quoteTransfer->getAcceptTerms() === true) {
            $this->customerFacade->registerCustomer($quoteTransfer->getCustomer());
        }

        return $saveOrderTransfer;
    }
}
