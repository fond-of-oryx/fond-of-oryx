<?php

namespace FondOfOryx\Zed\SplittableCheckout\Business\Workflow;

use ArrayObject;
use Exception;
use FondOfOryx\Zed\SplittableCheckout\Business\Exception\OrderNotPlacedException;
use FondOfOryx\Zed\SplittableCheckout\Communication\Plugin\PermissionExtension\PlaceOrderPermissionPlugin;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPermissionFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToSplittableQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutExtension\Dependency\Plugin\IdentifierExtractorPluginInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableCheckoutErrorTransfer;
use Generated\Shared\Transfer\SplittableCheckoutResponseTransfer;
use Psr\Log\LoggerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;
use Throwable;

class SplittableCheckoutWorkflow implements SplittableCheckoutWorkflowInterface
{
    use TransactionTrait;

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
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutExtension\Dependency\Plugin\IdentifierExtractorPluginInterface|null
     */
    protected $identifierExtractorPlugin;

    /**
     * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface $checkoutFacade
     * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToSplittableQuoteFacadeInterface $splittableQuoteFacade
     * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface $quoteFacade
     * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPermissionFacadeInterface $permissionFacade
     * @param \Psr\Log\LoggerInterface $logger
     * @param \FondOfOryx\Zed\SplittableCheckoutExtension\Dependency\Plugin\IdentifierExtractorPluginInterface|null $identifierExtractorPlugin
     */
    public function __construct(
        SplittableCheckoutToCheckoutFacadeInterface $checkoutFacade,
        SplittableCheckoutToSplittableQuoteFacadeInterface $splittableQuoteFacade,
        SplittableCheckoutToQuoteFacadeInterface $quoteFacade,
        SplittableCheckoutToPermissionFacadeInterface $permissionFacade,
        LoggerInterface $logger,
        ?IdentifierExtractorPluginInterface $identifierExtractorPlugin
    ) {
        $this->checkoutFacade = $checkoutFacade;
        $this->splittableQuoteFacade = $splittableQuoteFacade;
        $this->quoteFacade = $quoteFacade;
        $this->permissionFacade = $permissionFacade;
        $this->identifierExtractorPlugin = $identifierExtractorPlugin;
        $this->logger = $logger;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @throws \FondOfOryx\Zed\SplittableCheckout\Business\Exception\OrderNotPlacedException
     * @throws \Throwable
     *
     * @return \Generated\Shared\Transfer\SplittableCheckoutResponseTransfer
     */
    public function placeOrder(QuoteTransfer $quoteTransfer): SplittableCheckoutResponseTransfer
    {
        $self = $this;
        $splittableCheckoutResponseTransfer = (new SplittableCheckoutResponseTransfer())
            ->setIsSuccess(false);

        try {
            if (!$this->canPlaceOrder($quoteTransfer)) {
                $splittableCheckoutErrorTransfer = (new SplittableCheckoutErrorTransfer())
                    ->setMessage(static::ERROR_MESSAGE_PERMISSION_DENIED);

                return $splittableCheckoutResponseTransfer->addError($splittableCheckoutErrorTransfer);
            }

            $this->getTransactionHandler()->handleTransaction(
                static function () use ($quoteTransfer, &$splittableCheckoutResponseTransfer, $self) {
                    $splittableCheckoutResponseTransfer = $self->executePlaceOrder($quoteTransfer);

                    if ($splittableCheckoutResponseTransfer->getIsSuccess()) {
                        return;
                    }

                    throw new OrderNotPlacedException('Order could not be placed.');
                },
            );
        } catch (OrderNotPlacedException $exception) {
        } catch (Throwable $exception) {
            $this->logger->error($exception->getMessage(), [
                    'exception' => $exception->getMessage(),
                    'trace' => $exception->getTraceAsString(),
                    'data' => $quoteTransfer->serialize(),
                ]);

            throw $exception;
        }

        return $splittableCheckoutResponseTransfer;
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
     * @return \Generated\Shared\Transfer\SplittableCheckoutResponseTransfer
     */
    protected function placeSplitOrders(
        QuoteTransfer $quoteTransfer,
        array $splittedQuoteTransfers
    ): SplittableCheckoutResponseTransfer {
        $splittableCheckoutResponseTransfer = (new SplittableCheckoutResponseTransfer())
            ->setIsSuccess(false);

        foreach ($splittedQuoteTransfers as $splittedQuoteTransfer) {
            $checkoutResponseTransfer = $this->checkoutFacade->placeOrder($splittedQuoteTransfer);
            $saveOrderTransfer = $checkoutResponseTransfer->getSaveOrder();

            if ($saveOrderTransfer === null || $checkoutResponseTransfer->getIsSuccess() === false) {
                foreach ($checkoutResponseTransfer->getErrors() as $checkoutErrorTransfer) {
                    $splittableCheckoutErrorTransfer = (new SplittableCheckoutErrorTransfer())
                        ->fromArray($checkoutErrorTransfer->toArray(), true);

                    $splittableCheckoutResponseTransfer->addError($splittableCheckoutErrorTransfer);
                }

                return $splittableCheckoutResponseTransfer;
            }

            $splittedQuoteTransfer->setOrderReference($saveOrderTransfer->getOrderReference());
            $this->quoteFacade->deleteQuote($splittedQuoteTransfer);
        }

        $this->quoteFacade->deleteQuote($quoteTransfer);

        return $splittableCheckoutResponseTransfer
            ->setIsSuccess(true)
            ->setSplittedQuotes(new ArrayObject($splittedQuoteTransfers));
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
