<?php

namespace FondOfOryx\Zed\ProductLocaleRestriction\Persistence;

use Orm\Zed\ProductLocaleRestriction\Persistence\Map\FooProductAbstractLocaleRestrictionTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionPersistenceFactory getFactory()
 */
class ProductLocaleRestrictionRepository extends AbstractRepository implements ProductLocaleRestrictionRepositoryInterface
{
    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer[]
     */
    public function findLocaleBlacklistByIdProductAbstract(int $idProductAbstract): array
    {
        $fooProductAbstractLocaleRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractLocaleRestrictionQuery();

        $fooProductAbstractLocaleRestrictionCollection = $fooProductAbstractLocaleRestrictionQuery
            ->filterByFkProductAbstract($idProductAbstract)
            ->find();

        return $this->getFactory()->createProductAbstractLocaleRestrictionMapper()
            ->mapEntityCollectionToLocaleTransfers($fooProductAbstractLocaleRestrictionCollection);
    }

    /**
     * @param int $idProductAbstract
     *
     * @return int[]
     */
    public function findLocaleBlacklistIdsByIdProductAbstract(int $idProductAbstract): array
    {
        $fooProductAbstractLocaleRestrictionQuery = $this->getFactory()
            ->createFooProductAbstractLocaleRestrictionQuery();

        return $fooProductAbstractLocaleRestrictionQuery
            ->select(FooProductAbstractLocaleRestrictionTableMap::COL_FK_LOCALE)
            ->findByFkProductAbstract($idProductAbstract)
            ->toArray();
    }
}
