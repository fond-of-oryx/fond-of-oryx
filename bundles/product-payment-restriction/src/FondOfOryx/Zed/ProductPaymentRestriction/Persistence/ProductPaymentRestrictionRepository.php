<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionPersistenceFactory getFactory()
 */
class ProductPaymentRestrictionRepository extends AbstractRepository implements ProductPaymentRestrictionRepositoryInterface
{
    /**
     * @param array<int> $idProductAbstracts
     *
     * @return array
     */
    public function findBlacklistedPaymentMethodsByIdsProductAbstract(array $idProductAbstracts): array
    {
        $fooProductAbstractPaymentRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractPaymentRestrictionQuery();

        $fooProductAbstractPaymentRestrictionCollection = $fooProductAbstractPaymentRestrictionQuery
            ->filterByFkProductAbstract_In($idProductAbstracts)
            ->innerJoinWithPaymentMethod()
            ->find();

        return $this->getFactory()->createProductAbstractPaymentRestrictionMapper()
            ->mapEntityCollectionToGroupedPaymentNames($fooProductAbstractPaymentRestrictionCollection);
    }
}
