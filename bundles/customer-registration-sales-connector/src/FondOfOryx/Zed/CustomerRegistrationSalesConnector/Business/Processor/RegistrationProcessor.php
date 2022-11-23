<?php

namespace FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business\Processor;

use Exception;
use FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeInterface;
use Generated\Shared\Transfer\CustomerRegistrationAttributesTransfer;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;

class RegistrationProcessor implements RegistrationProcessorInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeInterface
     */
    protected $customerRegistrationFacade;

    /**
     * @param \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeInterface $customerRegistrationFacade
     */
    public function __construct(CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeInterface $customerRegistrationFacade)
    {
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
        if ($quoteTransfer->getCreateAccount() === true && $quoteTransfer->getAcceptTerms() === true) {
            $this->customerRegistrationFacade->customerRegistration($this->createRegistrationRequest($quoteTransfer));
        }

        return $saveOrderTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    protected function createRegistrationRequest(QuoteTransfer $quoteTransfer): CustomerRegistrationRequestTransfer
    {
        $customerTransfer = $quoteTransfer->getCustomer();
        if ($customerTransfer === null) {
            throw new Exception('Missing customer transfer to proceed registration process!');
        }
        $attributes = (new CustomerRegistrationAttributesTransfer())
            ->setEmail($customerTransfer->getEmail())
            ->setAcceptGdpr($quoteTransfer->getAcceptTerms())
            ->setSubscribe($quoteTransfer->getSignupNewsletter())
            ->setToken($customerTransfer->getRegistrationKey());

        return (new CustomerRegistrationRequestTransfer())->setAttributes($attributes);
    }
}
