<?php

namespace FondOfOryx\Zed\ProductLocaleRestriction\Persistence;

use Generated\Shared\Transfer\ProductAbstractLocaleRestrictionTransfer;
use Orm\Zed\ProductLocaleRestriction\Persistence\FooProductAbstractLocaleRestriction;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionPersistenceFactory getFactory()
 */
class ProductLocaleRestrictionEntityManager extends AbstractEntityManager implements ProductLocaleRestrictionEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractLocaleRestrictionTransfer $productAbstractLocaleRestriction
     *
     * @return void
     */
    public function createProductAbstractLocaleRestriction(
        ProductAbstractLocaleRestrictionTransfer $productAbstractLocaleRestriction
    ): void {
        $productAbstractLocaleRestriction->requireIdProductAbstract()
            ->requireIdLocale();

        $fooProductAbstractLocaleRestriction = $this->getFactory()->createProductAbstractLocaleRestrictionMapper()
            ->mapTransferToEntity(
                $productAbstractLocaleRestriction,
                new FooProductAbstractLocaleRestriction(),
            );

        $fooProductAbstractLocaleRestriction->save();
    }

    /**
     * @param int $idProductAbstract
     * @param array $localeIds
     *
     * @return void
     */
    public function deleteProductAbstractLocaleRestrictions(int $idProductAbstract, array $localeIds): void
    {
        $fooProductAbstractLocaleRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractLocaleRestrictionQuery();

        $fooProductAbstractLocaleRestrictions = $fooProductAbstractLocaleRestrictionQuery->filterByFkProductAbstract(
            $idProductAbstract,
        )->filterByFkLocale_In($localeIds)
            ->find();

        foreach ($fooProductAbstractLocaleRestrictions as $fooProductAbstractLocaleRestriction) {
            $fooProductAbstractLocaleRestriction->delete();
        }
    }
}
