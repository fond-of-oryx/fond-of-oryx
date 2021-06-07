<?php

namespace FondOfOryx\Zed\SplittableCheckout\Business\Workflow;

use ArrayObject;
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
     * SplittableCheckoutWorkflow constructor.
     *
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
                }
            );
        }catch (Exception $exception) {
            return (new SplittableCheckoutResponseTransfer())
                ->setIsSuccess(false)
                ->addError((new SplittableCheckoutErrorTransfer())->setMessage($exception->getMessage()));
        }
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SplittableCheckoutResponseTransfer
     *
     * @throws \Exception
     */
    protected function executePlaceOrder(QuoteTransfer $quoteTransfer): SplittableCheckoutResponseTransfer
    {
        $quoteTransfers = $this->splittableQuoteFacade->splitQuote($quoteTransfer);

        if (count($quoteTransfers) === 0) {
            throw new Exception('TODO');
        }

        $quoteTransfers = $this->persistSplittedQuotes($quoteTransfers);

        return $this->placeSplitOrders($quoteTransfer, $quoteTransfers);
    }
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer[] $quoteTransfers
     *
     * @return \Generated\Shared\Transfer\SplittableCheckoutResponseTransfer
     */
    protected function placeSplitOrders(
        QuoteTransfer $quoteTransfer,
        array $quoteTransfers
    ): SplittableCheckoutResponseTransfer {
        $splittableCheckoutResponseTransfer = new SplittableCheckoutResponseTransfer();
        $checkoutResponseOrderReferences = [];

        foreach ($quoteTransfers as $quoteTransfer) {
            $checkoutResponseTransfer = $this->checkoutFacade->placeOrder($quoteTransfer);

            if ($checkoutResponseTransfer->getIsSuccess() === false) {
                throw new Exception('#TODO');
            }

            $checkoutResponseOrderReferences[] = $checkoutResponseTransfer->getSaveOrder()->getOrderReference();
        }

        $this->quoteFacade->deleteQuote($quoteTransfer);

        return $splittableCheckoutResponseTransfer
            ->setIsSuccess(true)
            ->setOrderReferences($checkoutResponseOrderReferences);
    }

    /**
     * @param array<string, \Generated\Shared\Transfer\QuoteTransfer> $splittedQuoteTransfers
     * @return array<string, \Generated\Shared\Transfer\QuoteTransfer>
     * @throws \Exception
     */
    protected function persistSplittedQuotes(array $splittedQuoteTransfers): array
    {
        foreach ($splittedQuoteTransfers as $key => $splittedQuoteTransfer) {
            $quoteResponseTransfer = $this->quoteFacade->createQuote($splittedQuoteTransfer);
            $quoteTransfer = $quoteResponseTransfer->getQuoteTransfer();

            if ($quoteResponseTransfer->getIsSuccessful() === false || $quoteTransfer === null) {
                throw new Exception('#TODO');
            }
            $splittedQuoteTransfers[$key] = $quoteTransfer;
        }

        return $splittedQuoteTransfers;
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
