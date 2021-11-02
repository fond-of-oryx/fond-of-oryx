<?php

namespace FondOfOryx\Zed\ProductCountryRestriction\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ProductAbstractCountryRestrictionTransfer;
use Orm\Zed\ProductCountryRestriction\Persistence\FooProductAbstractCountryRestriction;
use Propel\Runtime\Collection\ObjectCollection;

interface ProductAbstractCountryRestrictionMapperInterface
{
    /**
     * @param \Propel\Runtime\Collection\ObjectCollection|\Orm\Zed\ProductCountryRestriction\Persistence\FooProductAbstractCountryRestriction[] $fooProductAbstractCountryRestrictionCollection
     *
     * @return array<\Generated\Shared\Transfer\CountryTransfer>
     */
    public function mapEntityCollectionToCountryTransfers(
        ObjectCollection $fooProductAbstractCountryRestrictionCollection
    ): array;

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractCountryRestrictionTransfer $transfer
     * @param \Orm\Zed\ProductCountryRestriction\Persistence\FooProductAbstractCountryRestriction $entity
     *
     * @return \Orm\Zed\ProductCountryRestriction\Persistence\FooProductAbstractCountryRestriction
     */
    public function mapTransferToEntity(
        ProductAbstractCountryRestrictionTransfer $transfer,
        FooProductAbstractCountryRestriction $entity
    ): FooProductAbstractCountryRestriction;

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection|\Orm\Zed\ProductCountryRestriction\Persistence\FooProductAbstractCountryRestriction[] $fooProductAbstractCountryRestrictionCollection
     * @param string|null $virtualColumnForGrouping
     *
     * @return array
     */
    public function mapEntityCollectionToGroupedCountryNames(
        ObjectCollection $fooProductAbstractCountryRestrictionCollection,
        ?string $virtualColumnForGrouping = null
    ): array;
}
