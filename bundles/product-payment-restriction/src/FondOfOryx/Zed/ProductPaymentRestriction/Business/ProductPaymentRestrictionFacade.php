<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Business;

use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ProductPaymentRestriction\Business\ProductPaymentRestrictionBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionRepository getRepository()()
 */
class ProductPaymentRestrictionFacade extends AbstractFacade implements ProductPaymentRestrictionFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\PaymentMethodsTransfer $paymentMethodsTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentMethodsTransfer
     */
    public function productPaymentRestrictionPaymentMethodFilter(
        PaymentMethodsTransfer $paymentMethodsTransfer,
        QuoteTransfer $quoteTransfer
    ): PaymentMethodsTransfer {
        return $this->getFactory()
            ->createProductPaymentRestrictionPaymentMethodFilter()
            ->filterPaymentMethods($paymentMethodsTransfer, $quoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function expandProductAbstract(
        ProductAbstractTransfer $productAbstractTransfer
    ): ProductAbstractTransfer {
        return $this->getFactory()
            ->createProductAbstractExpander()
            ->expand($productAbstractTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function persistProductAbstractPaymentRestrictions(ProductAbstractTransfer $productAbstractTransfer): ProductAbstractTransfer
    {
        $this->getFactory()
            ->createProductAbstractPaymentRestrictionsPersister()
            ->persist($productAbstractTransfer);

        return $productAbstractTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function createProductAbstractPaymentRestrictions(
        ProductAbstractTransfer $productAbstractTransfer
    ): ProductAbstractTransfer {
        $this->getFactory()
            ->createProductAbstractPaymentRestrictionsPersister()
            ->persist($productAbstractTransfer);

        return $productAbstractTransfer;
    }
}
