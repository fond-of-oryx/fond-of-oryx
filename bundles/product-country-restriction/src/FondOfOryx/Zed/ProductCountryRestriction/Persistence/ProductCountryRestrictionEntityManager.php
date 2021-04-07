<?php

namespace FondOfOryx\Zed\ProductCountryRestriction\Persistence;

use Generated\Shared\Transfer\ProductAbstractCountryRestrictionTransfer;
use Orm\Zed\ProductCountryRestriction\Persistence\FooProductAbstractCountryRestriction;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionPersistenceFactory getFactory()
 */
class ProductCountryRestrictionEntityManager extends AbstractEntityManager implements ProductCountryRestrictionEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractCountryRestrictionTransfer $productAbstractCountryRestriction
     *
     * @return void
     */
    public function createProductAbstractCountryRestriction(
        ProductAbstractCountryRestrictionTransfer $productAbstractCountryRestriction
    ): void {
        $productAbstractCountryRestriction->requireIdProductAbstract()
            ->requireIdCountry();

        $fooProductAbstractCountryRestriction = $this->getFactory()->createProductAbstractCountryRestrictionMapper()
            ->mapTransferToEntity(
                $productAbstractCountryRestriction,
                new FooProductAbstractCountryRestriction()
            );

        $fooProductAbstractCountryRestriction->save();
    }

    /**
     * @param int $idProductAbstract
     * @param int[] $countryIds
     *
     * @return void
     */
    public function deleteProductAbstractCountryRestrictions(int $idProductAbstract, array $countryIds): void
    {
        $fooProductAbstractCountryRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractCountryRestrictionQuery();

        $fooProductAbstractCountryRestrictions = $fooProductAbstractCountryRestrictionQuery->filterByFkProductAbstract(
            $idProductAbstract
        )->filterByFkCountry_In($countryIds)
            ->find();

        foreach ($fooProductAbstractCountryRestrictions as $fooProductAbstractCountryRestriction) {
            $fooProductAbstractCountryRestriction->delete();
        }
    }
}
