<?php

namespace FondOfOryx\Zed\ProductLocaleRestriction\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\ProductAbstractLocaleRestrictionTransfer;
use Orm\Zed\ProductLocaleRestriction\Persistence\FooProductAbstractLocaleRestriction;
use Propel\Runtime\Collection\ObjectCollection;

class ProductAbstractLocaleRestrictionMapper implements ProductAbstractLocaleRestrictionMapperInterface
{
    /**
     * @param \Propel\Runtime\Collection\ObjectCollection|\Orm\Zed\ProductLocaleRestriction\Persistence\FooProductAbstractLocaleRestriction[] $fooProductAbstractLocaleRestrictionCollection
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer[]
     */
    public function mapEntityCollectionToLocaleTransfers(
        ObjectCollection $fooProductAbstractLocaleRestrictionCollection
    ): array {
        $localTransfers = [];

        foreach ($fooProductAbstractLocaleRestrictionCollection as $fooProductAbstractLocaleRestriction) {
            $spyLocale = $fooProductAbstractLocaleRestriction->getLocale();
            $localTransfers[] = (new LocaleTransfer())->fromArray($spyLocale->toArray());
        }

        return $localTransfers;
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection|\Orm\Zed\ProductLocaleRestriction\Persistence\FooProductAbstractLocaleRestriction[] $fooProductAbstractLocaleRestrictionCollection
     * @param string|null $virtualColumnForGrouping
     *
     * @return array
     */
    public function mapEntityCollectionToGroupedLocaleNames(
        ObjectCollection $fooProductAbstractLocaleRestrictionCollection,
        ?string $virtualColumnForGrouping = null
    ): array {
        $groupedLocaleIds = [];

        foreach ($fooProductAbstractLocaleRestrictionCollection as $fooProductAbstractLocaleRestriction) {
            $key = $fooProductAbstractLocaleRestriction->getFkProductAbstract();
            $locale = $fooProductAbstractLocaleRestriction->getLocale();

            if ($virtualColumnForGrouping !== null) {
                $key = $fooProductAbstractLocaleRestriction->getVirtualColumn($virtualColumnForGrouping);
            }

            if (!isset($groupedLocaleIds[$key])) {
                $groupedLocaleIds[$key] = [];
            }

            $groupedLocaleIds[$key][] = $locale->getLocaleName();
        }

        return $groupedLocaleIds;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractLocaleRestrictionTransfer $transfer
     * @param \Orm\Zed\ProductLocaleRestriction\Persistence\FooProductAbstractLocaleRestriction $entity
     *
     * @return \Orm\Zed\ProductLocaleRestriction\Persistence\FooProductAbstractLocaleRestriction
     */
    public function mapTransferToEntity(
        ProductAbstractLocaleRestrictionTransfer $transfer,
        FooProductAbstractLocaleRestriction $entity
    ): FooProductAbstractLocaleRestriction {
        $entity->fromArray($transfer->toArray());

        return $entity->setFkLocale($transfer->getIdLocale())
            ->setFkProductAbstract($transfer->getIdProductAbstract());
    }
}
