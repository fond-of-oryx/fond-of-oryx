<?php

namespace FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence;

use Generated\Shared\Transfer\ProductAbstractCartCodeTypeRestrictionTransfer;
use Orm\Zed\ProductCartCodeTypeRestriction\Persistence\FooProductAbstractCartCodeTypeRestriction;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionPersistenceFactory getFactory()
 */
class ProductCartCodeTypeRestrictionEntityManager extends AbstractEntityManager implements ProductCartCodeTypeRestrictionEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractCartCodeTypeRestrictionTransfer $productAbstractCartCodeTypeRestriction
     *
     * @return void
     */
    public function createProductAbstractCartCodeTypeRestriction(
        ProductAbstractCartCodeTypeRestrictionTransfer $productAbstractCartCodeTypeRestriction
    ): void {
        $productAbstractCartCodeTypeRestriction->requireIdProductAbstract()
            ->requireIdCartCodeType();

        $fooProductAbstractCartCodeTypeRestriction = $this->getFactory()
            ->createProductAbstractCartCodeTypeRestrictionMapper()
            ->mapTransferToEntity(
                $productAbstractCartCodeTypeRestriction,
                new FooProductAbstractCartCodeTypeRestriction(),
            );

        $fooProductAbstractCartCodeTypeRestriction->save();
    }

    /**
     * @param int $idProductAbstract
     * @param array<int> $cartCodeTypeIds
     *
     * @return void
     */
    public function deleteProductAbstractCartCodeTypeRestrictions(int $idProductAbstract, array $cartCodeTypeIds): void
    {
        $fooProductAbstractCartCodeTypeRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractCartCodeTypeRestrictionQuery();

        $fooProductAbstractCartCodeTypeRestrictions = $fooProductAbstractCartCodeTypeRestrictionQuery
            ->filterByFkProductAbstract($idProductAbstract)
            ->filterByFkCartCodeType_In($cartCodeTypeIds)
            ->find();

        foreach ($fooProductAbstractCartCodeTypeRestrictions as $fooProductAbstractCartCodeTypeRestriction) {
            $fooProductAbstractCartCodeTypeRestriction->delete();
        }
    }
}
