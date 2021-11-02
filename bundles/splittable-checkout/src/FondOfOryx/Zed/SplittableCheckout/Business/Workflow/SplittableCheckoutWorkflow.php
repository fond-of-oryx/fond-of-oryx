<?php

namespace FondOfOryx\Zed\SplittableCheckout\Business\Workflow;

use Exception;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToSplittableQuoteFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableCheckoutErrorTransfer;
use Generated\Shared\Transfer\SplittableCheckoutResponseTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class SplittableCheckoutWorkflow implements SplittableCheckoutWorkflowInterface
{
    use TransactionTrait;

    /**
     * @var string
     */
    protected const ERROR_MESSAGE_ORDER_NOT_PLACED = 'splittable_checkout.error.order_not_placed';

    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface
     */
    protected $checkoutFacade;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface
     */
    protected $quoteFacade;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToSplittableQuoteFacadeInterface
     */
    protected $splittableQuoteFacade;

    /**
     * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface $checkoutFacade
     * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToSplittableQuoteFacadeInterface $splittableQuoteFacade
     * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface $quoteFacade
     */
    public function __construct(
        SplittableCheckoutToCheckoutFacadeInterface $checkoutFacade,
        SplittableCheckoutToSplittableQuoteFacadeInterface $splittableQuoteFacade,
        SplittableCheckoutToQuoteFacadeInterface $quoteFacade
    ) {
        $this->checkoutFacade = $checkoutFacade;
        $this->splittableQuoteFacade = $splittableQuoteFacade;
        $this->quoteFacade = $quoteFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SplittableCheckoutResponseTransfer
     */
    public function placeOrder(QuoteTransfer $quoteTransfer): SplittableCheckoutResponseTransfer
    {
        try {
            $self = $this;

            return $this->getTransactionHandler()->handleTransaction(
                static function () use ($quoteTransfer, $self) {
                    return $self->executePlaceOrder($quoteTransfer);
                },
            );
        } catch (Exception $exception) {
            $splittableCheckoutErrorTransfer = (new SplittableCheckoutErrorTransfer())
                ->setMessage(static::ERROR_MESSAGE_ORDER_NOT_PLACED);

            return (new SplittableCheckoutResponseTransfer())
                ->setIsSuccess(false)
                ->addError($splittableCheckoutErrorTransfer);
        }
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\SplittableCheckoutResponseTransfer
     */
    protected function executePlaceOrder(QuoteTransfer $quoteTransfer): SplittableCheckoutResponseTransfer
    {
        $splittedQuoteTransfers = $this->splittableQuoteFacade->splitQuote($quoteTransfer);

        if (count($splittedQuoteTransfers) === 0) {
            throw new Exception('Could not split quote.');
        }

        $splittedQuoteTransfers = $this->createSplittedQuotes($splittedQuoteTransfers);

        return $this->placeSplitOrders($quoteTransfer, $splittedQuoteTransfers);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param array<string, \Generated\Shared\Transfer\QuoteTransfer> $splittedQuoteTransfers
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\SplittableCheckoutResponseTransfer
     */
    protected function placeSplitOrders(
        QuoteTransfer $quoteTransfer,
        array $splittedQuoteTransfers
    ): SplittableCheckoutResponseTransfer {
        $splittableCheckoutResponseTransfer = new SplittableCheckoutResponseTransfer();
        $checkoutResponseOrderReferences = [];

        foreach ($splittedQuoteTransfers as $splittedQuoteTransfer) {
            $checkoutResponseTransfer = $this->checkoutFacade->placeOrder($splittedQuoteTransfer);
            $saveOrderTransfer = $checkoutResponseTransfer->getSaveOrder();

            if ($saveOrderTransfer === null || $checkoutResponseTransfer->getIsSuccess() === false) {
                throw new Exception('Could not place order.');
            }

            $this->quoteFacade->deleteQuote($splittedQuoteTransfer);
            $checkoutResponseOrderReferences[] = $saveOrderTransfer->getOrderReference();
        }

        $this->quoteFacade->deleteQuote($quoteTransfer);

        return $splittableCheckoutResponseTransfer
            ->setIsSuccess(true)
            ->setOrderReferences($checkoutResponseOrderReferences);
    }

    /**
     * @param array<string, \Generated\Shared\Transfer\QuoteTransfer> $splittedQuoteTransfers
     *
     * @throws \Exception
     *
     * @return array<string, \Generated\Shared\Transfer\QuoteTransfer>
     */
    protected function createSplittedQuotes(array $splittedQuoteTransfers): array
    {
        foreach ($splittedQuoteTransfers as $key => $splittedQuoteTransfer) {
            $quoteResponseTransfer = $this->quoteFacade->createQuote($splittedQuoteTransfer);
            $quoteTransfer = $quoteResponseTransfer->getQuoteTransfer();

            if ($quoteTransfer === null || $quoteResponseTransfer->getIsSuccessful() === false) {
                throw new Exception('Could not create splitted quote.');
            }

            $splittedQuoteTransfers[$key] = $quoteTransfer;
        }

        return $splittedQuoteTransfers;
    }
}
