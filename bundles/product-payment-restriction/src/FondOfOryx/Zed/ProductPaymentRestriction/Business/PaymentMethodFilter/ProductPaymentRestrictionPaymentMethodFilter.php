<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Business\PaymentMethodFilter;

use FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionRepositoryInterface;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class ProductPaymentRestrictionPaymentMethodFilter implements ProductPaymentRestrictionPaymentMethodFilterInterface
{
    /**
     * @var \FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionRepositoryInterface
     */
    protected $productPaymentRestrictionRepository;

    /**
     * @param \FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionRepositoryInterface $productPaymentRestrictionRepository
     */
    public function __construct(ProductPaymentRestrictionRepositoryInterface $productPaymentRestrictionRepository)
    {
        $this->productPaymentRestrictionRepository = $productPaymentRestrictionRepository;
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentMethodsTransfer $paymentMethodsTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentMethodsTransfer
     */
    public function filterPaymentMethods(
        PaymentMethodsTransfer $paymentMethodsTransfer,
        QuoteTransfer $quoteTransfer
    ): PaymentMethodsTransfer {
        $blacklistedPaymentMethods = $this->getBlacklistedPaymentMethodsFromQuoteProducts($quoteTransfer);

        if (count($blacklistedPaymentMethods) === 0) {
            return $paymentMethodsTransfer;
        }

        return $this->removeNotAllowedPaymentMethods($paymentMethodsTransfer, $blacklistedPaymentMethods);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array<int|string, \Generated\Shared\Transfer\PaymentMethodTransfer>
     */
    protected function getBlacklistedPaymentMethodsFromQuoteProducts(QuoteTransfer $quoteTransfer): array
    {
        $idsProductAbstract = [];
        $collection = [];

        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            $idsProductAbstract[] = $itemTransfer->getIdProductAbstract();
        }

        $blacklistedPaymentMethods = $this->productPaymentRestrictionRepository
            ->findBlacklistedPaymentMethodsByIdsProductAbstract($idsProductAbstract);

        foreach ($blacklistedPaymentMethods as $paymentMethodTransfer) {
            if (isset($collection[$paymentMethodTransfer->getIdPaymentMethod()])) {
                continue;
            }

            $collection[$paymentMethodTransfer->getIdPaymentMethod()] = $paymentMethodTransfer;
        }

        return $collection;
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentMethodsTransfer $paymentMethodsTransfer
     * @param array<int, \Generated\Shared\Transfer\PaymentMethodTransfer> $blacklistedPaymentMethods
     *
     * @return \Generated\Shared\Transfer\PaymentMethodsTransfer
     */
    protected function removeNotAllowedPaymentMethods(
        PaymentMethodsTransfer $paymentMethodsTransfer,
        array $blacklistedPaymentMethods
    ): PaymentMethodsTransfer {
        $filteredPaymentMethodsTransfer = new PaymentMethodsTransfer();

        foreach ($paymentMethodsTransfer->getMethods() as $paymentMethodTransfer) {
            if (isset($blacklistedPaymentMethods[$paymentMethodTransfer->getIdPaymentMethod()])) {
                continue;
            }

            $filteredPaymentMethodsTransfer->addMethod($paymentMethodTransfer);
        }

        return $filteredPaymentMethodsTransfer;
    }
}
