<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Persistence;

use Generated\Shared\Transfer\ProductAbstractPaymentRestrictionTransfer;
use Orm\Zed\ProductPaymentRestriction\Persistence\FooProductAbstractPaymentRestriction;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionPersistenceFactory getFactory()
 */
class ProductPaymentRestrictionEntityManager extends AbstractEntityManager implements ProductPaymentRestrictionEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractPaymentRestrictionTransfer $productAbstractPaymentRestriction
     *
     * @return void
     */
    public function createProductAbstractPaymentRestriction(
        ProductAbstractPaymentRestrictionTransfer $productAbstractPaymentRestriction
    ): void {
        $productAbstractPaymentRestriction->requireIdProductAbstract()
            ->requireIdPaymentMethod();

        $fooProductAbstractPaymentRestriction = $this->getFactory()->createProductAbstractPaymentRestrictionMapper()
            ->mapTransferToEntity(
                $productAbstractPaymentRestriction,
                new FooProductAbstractPaymentRestriction(),
            );

        $fooProductAbstractPaymentRestriction->save();
    }

    /**
     * @param int $idProductAbstract
     * @param array $paymentMethodIds
     *
     * @return void
     */
    public function deleteProductAbstractPaymentRestrictions(int $idProductAbstract, array $paymentMethodIds): void
    {
        $fooProductAbstractPaymentRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractPaymentRestrictionQuery();

        $fooProductAbstractPaymentRestrictions = $fooProductAbstractPaymentRestrictionQuery->filterByFkProductAbstract(
            $idProductAbstract,
        )->filterByFkPaymentMethod_In($paymentMethodIds)
            ->find();

        foreach ($fooProductAbstractPaymentRestrictions as $fooProductAbstractPaymentRestriction) {
            $fooProductAbstractPaymentRestriction->delete();
        }
    }
}
