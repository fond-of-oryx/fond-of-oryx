<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckout\Address;

use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCustomerFacadeInterface;
use Generated\Shared\Transfer\AddressesTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class AddressReader implements AddressReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCustomerFacadeInterface
     */
    protected $customerFacade;

    /**
     * @param \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCustomerFacadeInterface $customerFacade
     */
    public function __construct(SplittableCheckoutRestApiToCustomerFacadeInterface $customerFacade)
    {
        $this->customerFacade = $customerFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\AddressesTransfer
     */
    public function getAddressesTransfer(QuoteTransfer $quoteTransfer): AddressesTransfer
    {
        $customerTransfer = $quoteTransfer->getCustomer();
        if (!$customerTransfer || $customerTransfer->getIsGuest()) {
            return new AddressesTransfer();
        }

        $customerResponseTransfer = $this->customerFacade->findCustomerByReference($customerTransfer->getCustomerReference());
        if (!$customerResponseTransfer->getHasCustomer()) {
            return new AddressesTransfer();
        }

        return $this->extendAddressesWithDefaultBillingAndShipping($customerResponseTransfer->getCustomerTransfer());
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\AddressesTransfer
     */
    protected function extendAddressesWithDefaultBillingAndShipping(
        CustomerTransfer $customerTransfer
    ): AddressesTransfer {
        $addressesTransfer = new AddressesTransfer();
        foreach ($customerTransfer->getAddresses()->getAddresses() as $addressKey => $addressTransfer) {
            $addressTransfer->setIsDefaultShipping(
                $addressTransfer->getIdCustomerAddress() === (int)$customerTransfer->getDefaultShippingAddress()
            );
            $addressTransfer->setIsDefaultBilling(
                $addressTransfer->getIdCustomerAddress() === (int)$customerTransfer->getDefaultBillingAddress()
            );

            $addressesTransfer->addAddress($addressTransfer);
        }

        return $addressesTransfer;
    }
}
