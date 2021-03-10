<?php

namespace FondOfOryx\Zed\SplittableCheckout\Business\Workflow;

use ArrayObject;
use FondOfOryx\Zed\SplittableCheckout\Business\Model\QuoteSplitterInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface;
use Generated\Shared\Transfer\QuoteCollectionTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableCheckoutResponseTransfer;

class SplittableCheckoutWorkflow implements SplittableCheckoutWorkflowInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface
     */
    protected $checkoutFacade;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface
     */
    protected $quoteFacade;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\Business\Model\QuoteSplitterInterface
     */
    protected $quoteSplitter;

    /**
     * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface $checkoutFacade
     * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface $quoteFacade
     * @param \FondOfOryx\Zed\SplittableCheckout\Business\Model\QuoteSplitterInterface $quoteSplitter
     */
    public function __construct(
        SplittableCheckoutToCheckoutFacadeInterface $checkoutFacade,
        SplittableCheckoutToQuoteFacadeInterface $quoteFacade,
        QuoteSplitterInterface $quoteSplitter
    ) {
        $this->checkoutFacade = $checkoutFacade;
        $this->quoteFacade = $quoteFacade;
        $this->quoteSplitter = $quoteSplitter;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SplittableCheckoutResponseTransfer
     */
    public function placeOrder(QuoteTransfer $quoteTransfer): SplittableCheckoutResponseTransfer
    {
        $quoteCollectionTransfer = $this->quoteSplitter->split($quoteTransfer);

        if (count($quoteCollectionTransfer->getQuotes()) === 0) {
            return (new SplittableCheckoutResponseTransfer())->setIsSuccess(true);
        }

        return $this->placeSplitOrders($quoteCollectionTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteCollectionTransfer $quoteCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\SplittableCheckoutResponseTransfer
     */
    protected function placeSplitOrders(
        QuoteCollectionTransfer $quoteCollectionTransfer
    ): SplittableCheckoutResponseTransfer {
        $splittableCheckoutResponseTransfer = new SplittableCheckoutResponseTransfer();
        $checkoutResponseErrors = new ArrayObject();
        $checkoutResponseOrderReferences = [];
        foreach ($quoteCollectionTransfer->getQuotes() as $quoteTransfer) {
            $checkoutResponseTransfer = $this->checkoutFacade->placeOrder($quoteTransfer);

            if ($checkoutResponseTransfer->getIsSuccess() === false) {
                $checkoutResponseErrors->append(
                    $this->mapCheckoutErrorsToSplittableCheckoutErrors($checkoutResponseTransfer->getErrors())
                );

                continue;
            }

            $this->quoteFacade->deleteQuote($quoteTransfer);
            $checkoutResponseOrderReferences[] = $checkoutResponseTransfer->getSaveOrder()->getOrderReference();
        }

        return $splittableCheckoutResponseTransfer
            ->setIsSuccess(true)
            ->setErrors($checkoutResponseErrors)
            ->setOrderReferences($checkoutResponseOrderReferences);
    }

    /**
     * @param \ArrayObject $errors
     *
     * @return \ArrayObject
     */
    protected function mapCheckoutErrorsToSplittableCheckoutErrors(ArrayObject $errors): ArrayObject
    {
        $splittableCheckoutErrors = new ArrayObject();

        return $splittableCheckoutErrors;
    }
}
