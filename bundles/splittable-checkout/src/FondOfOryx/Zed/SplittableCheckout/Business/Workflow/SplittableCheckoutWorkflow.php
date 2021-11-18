<?php

namespace FondOfOryx\Zed\SplittableCheckout\Business\Workflow;

use Exception;
use FondOfOryx\Zed\SplittableCheckout\Business\Exception\PermissionDeniedException;
use FondOfOryx\Zed\SplittableCheckout\Communication\Plugin\PermissionExtension\PlaceOrderPermissionPlugin;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPermissionFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToSplittableQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutExtension\Dependency\Plugin\IdentifierExtractorPluginInterface;
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
     * @var string
     */
    protected const ERROR_MESSAGE_PERMISSION_DENIED = 'splittable_checkout.error.permission_denied';

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
     * @var \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPermissionFacadeInterface
     */
    protected $permissionFacade;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutExtension\Dependency\Plugin\IdentifierExtractorPluginInterface|null
     */
    protected $identifierExtractorPlugin;

    /**
     * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface $checkoutFacade
     * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToSplittableQuoteFacadeInterface $splittableQuoteFacade
     * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface $quoteFacade
     * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPermissionFacadeInterface $permissionFacade
     * @param \FondOfOryx\Zed\SplittableCheckoutExtension\Dependency\Plugin\IdentifierExtractorPluginInterface|null $identifierExtractorPlugin
     */
    public function __construct(
        SplittableCheckoutToCheckoutFacadeInterface $checkoutFacade,
        SplittableCheckoutToSplittableQuoteFacadeInterface $splittableQuoteFacade,
        SplittableCheckoutToQuoteFacadeInterface $quoteFacade,
        SplittableCheckoutToPermissionFacadeInterface $permissionFacade,
        ?IdentifierExtractorPluginInterface $identifierExtractorPlugin
    ) {
        $this->checkoutFacade = $checkoutFacade;
        $this->splittableQuoteFacade = $splittableQuoteFacade;
        $this->quoteFacade = $quoteFacade;
        $this->permissionFacade = $permissionFacade;
        $this->identifierExtractorPlugin = $identifierExtractorPlugin;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @throws \FondOfOryx\Zed\SplittableCheckout\Business\Exception\PermissionDeniedException
     *
     * @return \Generated\Shared\Transfer\SplittableCheckoutResponseTransfer
     */
    public function placeOrder(QuoteTransfer $quoteTransfer): SplittableCheckoutResponseTransfer
    {
        try {
            $self = $this;

            if (!$this->canPlaceOrder($quoteTransfer)) {
                throw new PermissionDeniedException();
            }

            return $this->getTransactionHandler()->handleTransaction(
                static function () use ($quoteTransfer, $self) {
                    return $self->executePlaceOrder($quoteTransfer);
                },
            );
        } catch (PermissionDeniedException $exception) {
            $splittableCheckoutErrorTransfer = (new SplittableCheckoutErrorTransfer())
                ->setMessage(static::ERROR_MESSAGE_PERMISSION_DENIED);
        } catch (Exception $exception) {
            $splittableCheckoutErrorTransfer = (new SplittableCheckoutErrorTransfer())
                ->setMessage(static::ERROR_MESSAGE_ORDER_NOT_PLACED);
        }

        return (new SplittableCheckoutResponseTransfer())
            ->setIsSuccess(false)
            ->addError($splittableCheckoutErrorTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    protected function canPlaceOrder(QuoteTransfer $quoteTransfer): bool
    {
        if ($this->identifierExtractorPlugin === null) {
            return true;
        }

        $identifier = $this->identifierExtractorPlugin->extract($quoteTransfer);

        if ($identifier === null) {
            return false;
        }

        return $this->permissionFacade->can(PlaceOrderPermissionPlugin::KEY, $identifier);
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
