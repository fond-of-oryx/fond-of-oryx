<?php

namespace FondOfOryx\Zed\ProductCountryRestriction\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CountryTransfer;
use Generated\Shared\Transfer\ProductAbstractCountryRestrictionTransfer;
use Orm\Zed\ProductCountryRestriction\Persistence\FooProductAbstractCountryRestriction;
use Propel\Runtime\Collection\ObjectCollection;

class ProductAbstractCountryRestrictionMapper implements ProductAbstractCountryRestrictionMapperInterface
{
    /**
     * @param \Propel\Runtime\Collection\ObjectCollection $fooProductAbstractCountryRestrictionCollection
     *
     * @return \Generated\Shared\Transfer\CountryTransfer[]
     */
    public function mapEntityCollectionToCountryTransfers(
        ObjectCollection $fooProductAbstractCountryRestrictionCollection
    ): array {
        $countryTransfers = [];

        foreach ($fooProductAbstractCountryRestrictionCollection as $fooProductAbstractCountryRestriction) {
            $spyCountry = $fooProductAbstractCountryRestriction->getCountry();
            $countryTransfers[] = (new CountryTransfer())->fromArray($spyCountry->toArray());
        }

        return $countryTransfers;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractCountryRestrictionTransfer $transfer
     * @param \Orm\Zed\ProductCountryRestriction\Persistence\FooProductAbstractCountryRestriction $entity
     *
     * @return \Orm\Zed\ProductCountryRestriction\Persistence\FooProductAbstractCountryRestriction
     */
    public function mapTransferToEntity(
        ProductAbstractCountryRestrictionTransfer $transfer,
        FooProductAbstractCountryRestriction $entity
    ): FooProductAbstractCountryRestriction {
        $entity->fromArray($transfer->toArray());

        return $entity->setFkCountry($transfer->getIdCountry())
            ->setFkProductAbstract($transfer->getIdProductAbstract());
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection|\Orm\Zed\ProductCountryRestriction\Persistence\FooProductAbstractCountryRestriction[] $fooProductAbstractCountryRestrictionCollection
     * @param string|null $virtualColumnForGrouping
     *
     * @return array
     */
    public function mapEntityCollectionToGroupedCountryNames(
        ObjectCollection $fooProductAbstractCountryRestrictionCollection,
        ?string $virtualColumnForGrouping = null
    ): array {
        $groupedCountryIds = [];

        foreach ($fooProductAbstractCountryRestrictionCollection as $fooProductAbstractCountryRestriction) {
            $key = $fooProductAbstractCountryRestriction->getFkProductAbstract();
            $country = $fooProductAbstractCountryRestriction->getCountry();

            if ($virtualColumnForGrouping !== null) {
                $key = $fooProductAbstractCountryRestriction->getVirtualColumn($virtualColumnForGrouping);
            }

            if (!isset($groupedCountryIds[$key])) {
                $groupedCountryIds[$key] = [];
            }

            $groupedCountryIds[$key][] = $country->getIso2Code();
        }

        return $groupedCountryIds;
    }
}
