<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Business\Expander;

use FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Persistence\SplittableCheckoutRestApiCustomerConnectorRepositoryInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;

class QuoteExpander implements QuoteExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Persistence\SplittableCheckoutRestApiCustomerConnectorRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Persistence\SplittableCheckoutRestApiCustomerConnectorRepositoryInterface $repository
     */
    public function __construct(SplittableCheckoutRestApiCustomerConnectorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        if ($quoteTransfer->getCustomer() !== null) {
            return $quoteTransfer;
        }

        if ($quoteTransfer->getCustomerReference() === null) {
            return $quoteTransfer;
        }

        $customerTransfer = $this->repository->getCustomerByCustomerReference($quoteTransfer->getCustomerReference());

        if ($customerTransfer === null) {
            return $quoteTransfer;
        }

        return $quoteTransfer->setCustomer($customerTransfer);
    }
}
