<?php

namespace FondOfOryx\Zed\ProductLocaleRestriction\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ProductAbstractLocaleRestrictionTransfer;
use Orm\Zed\ProductLocaleRestriction\Persistence\FooProductAbstractLocaleRestriction;
use Propel\Runtime\Collection\ObjectCollection;

interface ProductAbstractLocaleRestrictionMapperInterface
{
    /**
     * @param \Propel\Runtime\Collection\ObjectCollection|\Orm\Zed\ProductLocaleRestriction\Persistence\FooProductAbstractLocaleRestriction[] $fooProductAbstractLocaleRestrictionCollection
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer[]
     */
    public function mapEntityCollectionToLocaleTransfers(
        ObjectCollection $fooProductAbstractLocaleRestrictionCollection
    ): array;

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractLocaleRestrictionTransfer $transfer
     * @param \Orm\Zed\ProductLocaleRestriction\Persistence\FooProductAbstractLocaleRestriction $entity
     *
     * @return \Orm\Zed\ProductLocaleRestriction\Persistence\FooProductAbstractLocaleRestriction
     */
    public function mapTransferToEntity(
        ProductAbstractLocaleRestrictionTransfer $transfer,
        FooProductAbstractLocaleRestriction $entity
    ): FooProductAbstractLocaleRestriction;
}
