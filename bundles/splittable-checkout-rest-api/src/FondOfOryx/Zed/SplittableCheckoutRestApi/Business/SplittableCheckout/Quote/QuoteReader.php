<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckout\Quote;

use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCartsRestApiFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;

class QuoteReader implements QuoteReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCartsRestApiFacadeInterface
     */
    protected $cartsRestApiFacade;

    /**
     * @param \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCartsRestApiFacadeInterface $cartsRestApiFacade
     */
    public function __construct(SplittableCheckoutRestApiToCartsRestApiFacadeInterface $cartsRestApiFacade)
    {
        $this->cartsRestApiFacade = $cartsRestApiFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer|null
     */
    public function findCustomerQuoteByUuid(
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
    ): ?QuoteTransfer {
        if (
            !$restSplittableCheckoutRequestAttributesTransfer->getCustomer()
            || !$restSplittableCheckoutRequestAttributesTransfer->getCustomer()->getCustomerReference()
        ) {
            return null;
        }

        $quoteTransfer = $this->createQuoteTransfer($restSplittableCheckoutRequestAttributesTransfer);

        $quoteResponseTransfer = $this->cartsRestApiFacade->findQuoteByUuid($quoteTransfer);

        if (!$quoteResponseTransfer->getIsSuccessful()) {
            return null;
        }

        $customerReference = $restSplittableCheckoutRequestAttributesTransfer->getCustomer()->getCustomerReference();
        if ($quoteResponseTransfer->getQuoteTransfer()->getCustomerReference() !== $customerReference) {
            return null;
        }

        $quoteTransfer = $quoteResponseTransfer->getQuoteTransfer();
        if (!$quoteTransfer->getCustomer()) {
            $customerTransfer = (new CustomerTransfer())->setCustomerReference($customerReference);
            $quoteTransfer->setCustomer($customerTransfer);
        }

        return $quoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function createQuoteTransfer(
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
    ): QuoteTransfer {
        $customerTransfer = (new CustomerTransfer())
            ->fromArray($restSplittableCheckoutRequestAttributesTransfer->getCustomer()->toArray(), true);

        return (new QuoteTransfer())
            ->setUuid($restSplittableCheckoutRequestAttributesTransfer->getIdCart())
            ->setCustomerReference($restSplittableCheckoutRequestAttributesTransfer->getCustomer()->getCustomerReference())
            ->setCustomer($customerTransfer);
    }
}
