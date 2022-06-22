<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Persistence;

use Orm\Zed\ProductPaymentRestriction\Persistence\Map\FooProductAbstractPaymentRestrictionTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionPersistenceFactory getFactory()
 */
class ProductPaymentRestrictionRepository extends AbstractRepository implements ProductPaymentRestrictionRepositoryInterface
{
    /**
     * @param array<int> $idProductAbstracts
     *
     * @return array<\Generated\Shared\Transfer\PaymentMethodTransfer>
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
            ->mapEntityCollectionToPaymentMethodTransfers($fooProductAbstractPaymentRestrictionCollection);
    }

    /**
     * @param int $idProductAbstract
     *
     * @return array<int>
     */
    public function findBlacklistedPaymentMethodIdsByIdProductAbstract(int $idProductAbstract): array
    {
        $fooProductAbstractPaymentRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractPaymentRestrictionQuery();

        return $fooProductAbstractPaymentRestrictionQuery
            ->select(FooProductAbstractPaymentRestrictionTableMap::COL_FK_PAYMENT_METHOD)
            ->findByFkProductAbstract($idProductAbstract)
            ->toArray();
    }
}
