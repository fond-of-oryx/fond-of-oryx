<?php

namespace FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ProductAbstractCartCodeTypeRestrictionTransfer;
use Orm\Zed\ProductCartCodeTypeRestriction\Persistence\FooProductAbstractCartCodeTypeRestriction;
use Propel\Runtime\Collection\ObjectCollection;

interface ProductAbstractCartCodeTypeRestrictionMapperInterface
{
    /**
     * @param \Propel\Runtime\Collection\ObjectCollection|\Orm\Zed\ProductCartCodeTypeRestriction\Persistence\FooProductAbstractCartCodeTypeRestriction[] $entityCollection
     *
     * @return \Generated\Shared\Transfer\CartCodeTypeTransfer[]
     */
    public function mapEntityCollectionToCartCodeTypeTransfers(
        ObjectCollection $entityCollection
    ): array;

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractCartCodeTypeRestrictionTransfer $transfer
     * @param \Orm\Zed\ProductCartCodeTypeRestriction\Persistence\FooProductAbstractCartCodeTypeRestriction $entity
     *
     * @return \Orm\Zed\ProductCartCodeTypeRestriction\Persistence\FooProductAbstractCartCodeTypeRestriction
     */
    public function mapTransferToEntity(
        ProductAbstractCartCodeTypeRestrictionTransfer $transfer,
        FooProductAbstractCartCodeTypeRestriction $entity
    ): FooProductAbstractCartCodeTypeRestriction;

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection|\Orm\Zed\ProductCartCodeTypeRestriction\Persistence\FooProductAbstractCartCodeTypeRestriction[] $entityCollection
     * @param string|null $virtualColumnForGrouping
     *
     * @return array
     */
    public function mapEntityCollectionToGroupedCartCodeTypeNames(
        ObjectCollection $entityCollection,
        ?string $virtualColumnForGrouping = null
    ): array;
}
