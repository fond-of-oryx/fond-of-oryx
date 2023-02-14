<?php

namespace FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business\Processor;

use FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerFacadeInterface;
use FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeInterface;
use Generated\Shared\Transfer\CustomerRegistrationTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;

class RegistrationProcessor implements RegistrationProcessorInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerFacadeInterface
     */
    protected CustomerRegistrationSalesConnectorToCustomerFacadeInterface $customerFacade;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeInterface
     */
    protected CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeInterface $customerRegistrationFacade;

    /**
     * @param \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerFacadeInterface $customerFacade
     * @param \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeInterface $customerRegistrationFacade
     */
    public function __construct(
        CustomerRegistrationSalesConnectorToCustomerFacadeInterface $customerFacade,
        CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeInterface $customerRegistrationFacade
    ) {
        $this->customerFacade = $customerFacade;
        $this->customerRegistrationFacade = $customerRegistrationFacade;
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
            if ($quoteTransfer->getCustomer()->getIdCustomer() !== null) {
                $this->customerRegistrationFacade->handleKnownCustomer(
                    (new CustomerRegistrationTransfer())->setCustomer($quoteTransfer->getCustomer()),
                );
            } else {
                $this->customerFacade->registerCustomer($quoteTransfer->getCustomer());
            }
        }

        return $saveOrderTransfer;
    }
}
